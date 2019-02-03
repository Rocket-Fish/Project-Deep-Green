<template>
  <div>
    <vue-headful title="Deep Green Ocean"/>
    <div id="Three-js-canvas" class= "Three-js-canvas">
      <div style="position: absolute; color:white; width:100%; height:100%">
        <component :is="child_component"></component>
      </div>
    </div>
  </div>
</template>

<script>
import * as THREE from 'three';

// cross class variables are bad for oop
// testing purposes only
//const seaRadius = 600;
//const cloudDistance = 200;

const colors = {
  white:0xffffff,
  water:0x00C6C6,
  sand:0xC38200,
  fog:0xf0f0f0
};


class Sea {
  constructor(radius) {
    let radialSegments = 40;
    const radialIncrement = 2;
    const minRadius = 200;
    const maxRadius = 1000;
    const incrementThreshold = 18
    // im going to assume that larger screen = better pc hardware
    // adding more verts to larger radius to make the water effect
    // behave more like water
    // also rardius is half of the viewport size

    // ensure that our value is between min and max radius values
    const playgroundValue = Math.max(minRadius, (Math.min(maxRadius, radius)));
    // determine number of times we need to add vertices
    // math.floor ensures that we get an int
    let numAdditions = Math.floor((radius-minRadius)/incrementThreshold);
    // apply the increments
    for(let i = 0; i < numAdditions; i ++) {
      radialSegments += radialIncrement;
    }

    this.geom = new THREE.CylinderGeometry(radius,radius,800,radialSegments,10);
    // rotate the geometry on the x axis
    this.geom.applyMatrix(new THREE.Matrix4().makeRotationX(-Math.PI/2));

    // create a wave array, containing objects with information about each vert
    this.waves = [];

    for (let vert of this.geom.vertices) {
      this.waves.push({
        y:vert.y,
        x:vert.x,
        z:vert.z,
        angle:Math.random()*Math.PI*2,
        // also going to adjust the amplitude of the wave depending on screen size
        amplitude: Math.random()*Math.max(Math.min(numAdditions/2, 40), 15),
        // a random speed between 0.016 and 0.048 radians / frame
        speed:0.016 + Math.random()*0.032
      });
    }


    // make a material
    let mat = new THREE.MeshPhongMaterial({
      color:colors.water,
      transparent:true,
      opacity:.8,
      flatShading:true,
    });

    // To create an object in Three.js, we have to create a mesh
    // which is a combination of a geometry and some material
    this.mesh = new THREE.Mesh(this.geom, mat);

    // Allow the sea to receive shadows
    this.mesh.receiveShadow = true;

  }

  updateWaves() {
    var verts = this.mesh.geometry.vertices;
    var waves = this.waves;
    for(let i = 0; i < waves.length; i ++) {
      let vert = verts[i];
      let wave = waves[i];

      // update the position of the vertex
  		vert.x = wave.x + Math.cos(wave.angle)*wave.amplitude;
  		vert.y = wave.y + Math.sin(wave.angle)*wave.amplitude;

  		// increment the angle for the next frame
  		wave.angle += wave.speed;
    }
    // this line is important, otherwise three js caches the mesh
    // and we won't get to dynamically change it.
    this.mesh.geometry.verticesNeedUpdate=true;
  }
}

class Cloud {
  constructor() {
    // Create an empty container that will hold the different parts of the cloud
    this.mesh = new THREE.Object3D();

    // create a cube geometry;
    // this shape will be duplicated to create the cloud
    let geom = new THREE.BoxGeometry(20,20,20);

    // create a material; a simple white material will do the trick
    let mat = new THREE.MeshPhongMaterial({
      color:colors.white,
    });

    // duplicate the geometry a random number of times
    let nBlocs = 3+Math.floor(Math.random()*3);
    for (let i=0; i<nBlocs; i++ ){

      // create the mesh by cloning the geometry
      let m = new THREE.Mesh(geom, mat);

      // set the position and the rotation of each cube randomly
      m.position.x = i*15;
      m.position.y = Math.random()*10;
      m.position.z = Math.random()*10;
      m.rotation.z = Math.random()*Math.PI*2;
      m.rotation.y = Math.random()*Math.PI*2;

      // set the size of the cube randomly
      let s = .1 + Math.random()*.9;
      m.scale.set(s,s,s);

      // allow each cube to cast and to receive shadows
      m.castShadow = true;
      m.receiveShadow = true;

      // add the cube to the container we first created
      this.mesh.add(m);
    }
  }
}

class Sky{
  constructor(radius) {
    // Create an empty container
    this.mesh = new THREE.Object3D();

    // choose a number of clouds to be scattered in the sky
    this.nClouds = 20;

    // To distribute the clouds consistently,
    // we need to place them according to a uniform angle
    let stepAngle = Math.PI*2 / this.nClouds;

    // create the clouds
    for(let i=0; i<this.nClouds; i++){
      let c = new Cloud();

      // set the rotation and the position of each cloud;
      // for that we use a bit of trigonometry
      let a = stepAngle*i; // this is the final angle of the cloud
      let h = radius + Math.random()*200; // this is the distance between the center of the axis and the cloud itself

      // Trigonometry!!! I hope you remember what you've learned in Math :)
      // in case you don't:
      // we are simply converting polar coordinates (angle, distance) into Cartesian coordinates (x, y)
      c.mesh.position.y = Math.sin(a)*h;
      c.mesh.position.x = Math.cos(a)*h;

      // rotate the cloud according to its position
      c.mesh.rotation.z = a + Math.PI/2;

      // for a better result, we position the clouds
      // at random depths inside of the scene
      c.mesh.position.z = -400-Math.random()*400;

      // we also set a random scale for each cloud
      let s = 1+Math.random()*2;
      c.mesh.scale.set(s,s,s);

      // add cloud into scene
      this.mesh.add(c.mesh);
    }
  }
}

export default {
  props: {
    child_component: Object,
  },
  data() {
    return {
      seaRadius: 600,
      cloudRadius: 800,
      cloudDistance: 200,


      THREE: THREE,
      camera: null,
      scene: null,
      renderer: null,
      container: null,

      fieldOfView: null,
      aspectRatio: null,
      nearPlane: null,
      farPlane: null,
      HEIGHT: null,
      WIDTH: null,

      hemisphereLight: null,
      shadowLight: null,

      sea: null,
      sky: null,

      colors: colors,
      requestedAnimationFame: null,
    }
  },
  methods: {
    init() {
        // make scene

        this.createScene();
        // add lightings
        this.createLights();


        // make sea radius relative to the window size for better scaling
        // on various devices
        this.seaRadius = (window.innerWidth/2);
        this.cloudRadius = this.seaRadius+this.cloudDistance;
        // create objects like sky and sea
        this.createSea(this.seaRadius);
        this.createSky(this.cloudRadius);


        this.handleResize();
    },
    createScene() {
      // Get window dimentions to determine viewport size
      this.HEIGHT = window.innerHeight;
    	this.WIDTH = window.innerWidth;

      // Create the scene
    	this.scene = new THREE.Scene();

      this.scene.fog = new THREE.Fog(this.colors.fog, 100, 950);

      // Create the camera
      this.aspectRatio = this.WIDTH / this.HEIGHT;
      this.fieldOfView = 60;
      this.nearPlane = 0.01;
      this.farPlane = 10000;
      this.camera = new THREE.PerspectiveCamera(
        this.fieldOfView,
        this.aspectRatio,
        this.nearPlane,
        this.farPlane
        );

      // Set the position of the camera
    	this.camera.position.x = 0;
    	this.camera.position.z = 200;
    	this.camera.position.y = 100;

      // Create the renderer
      this.renderer = new THREE.WebGLRenderer({
        // Allow transparency so we can see background
        alpha: true,
        // Activate the anti-aliasing;
        antialias: true
      });

      // Define the size of the renderer; in this case,
      // it will fill the entire screen
      this.renderer.setSize(this.WIDTH, this.HEIGHT);

      // Enable shadow rendering
      this.renderer.shadowMap.enabled = true;

      // this is really un-vue but.. can't think of a better way to do this atm
      this.container = document.getElementById('Three-js-canvas');
      // add the renderer into the dom to be rendered
      this.container.appendChild(this.renderer.domElement);
    },
    createLights() {
      // A hemisphere light is a gradient colored light;
    	// the first parameter is the sky color, the second parameter is the ground color,
    	// the third parameter is the intensity of the light
    	this.hemisphereLight = new THREE.HemisphereLight(0xaaaaaa,0x000000, .9)

    	// A directional light shines from a specific direction.
    	// It acts like the sun, that means that all the rays produced are parallel.
    	this.shadowLight = new THREE.DirectionalLight(0xffffff, .9);

    	// Set the direction of the light
    	this.shadowLight.position.set(150, 350, 350);

    	// Allow shadow casting
    	this.shadowLight.castShadow = true;

    	// define the visible area of the projected shadow
    	this.shadowLight.shadow.camera.left = -400;
    	this.shadowLight.shadow.camera.right = 400;
    	this.shadowLight.shadow.camera.top = 400;
    	this.shadowLight.shadow.camera.bottom = -400;
    	this.shadowLight.shadow.camera.near = 1;
    	this.shadowLight.shadow.camera.far = 1000;

    	// define the resolution of the shadow; the higher the better,
    	// but also the more expensive and less performant
    	this.shadowLight.shadow.mapSize.width = 2048;
    	this.shadowLight.shadow.mapSize.height = 2048;

    	// to activate the lights, just add them to the scene
    	this.scene.add(this.hemisphereLight);
    	this.scene.add(this.shadowLight);

      // an ambient light modifies the global color of a scene and makes the shadows softer
      let ambientLight = new THREE.AmbientLight(this.colors.water, .05);
      this.scene.add(ambientLight);
    },
    createSea(radius) {
      // make a new sea object
      this.sea = new Sea(radius);

      // sea position
      this.sea.mesh.position.y = -radius+50;

      // add sea to scene
      this.scene.add(this.sea.mesh);
    },
    createSky(cloudRadius) {
      this.sky = new Sky( cloudRadius );
    	this.sky.mesh.position.y = -cloudRadius+this.cloudDistance+50;
    	this.scene.add(this.sky.mesh);
    },
    animate() {
        this.requestedAnimationFame = requestAnimationFrame(this.animate);
        // the z axix is the axis facing us.
        this.sea.updateWaves();
        this.sea.mesh.rotation.z += 0.0015;
        this.sky.mesh.rotation.z += 0.0015;
        this.renderer.render(this.scene, this.camera);
    },
    handleResize() {
      this.camera.aspect = window.innerWidth / window.innerHeight
      this.camera.updateProjectionMatrix()
      // *0.99 width because to remove the side scrolling bar
      this.renderer.setSize(window.innerWidth, window.innerHeight)
    },
    deconstruct() {
        // stop animations
        cancelAnimationFrame(this.requestedAnimationFame);
        this.requestAnimationFrame = null;

        // set everything to null so javascript garbage collector
        // could collect the junk so no memory leaks

        this.scene = null;
        this.camera = null;
        this.scene = null;
        this.renderer = null;
        this.container = null;

        this.fieldOfView = null;
        this.aspectRatio = null;
        this.nearPlane = null;
        this.farPlane = null;
        this.HEIGHT = null;
        this.WIDTH = null;

        this.hemisphereLight = null;
        this.shadowLight = null;

        this.sea = null;
        this.sky = null;
    }
  },
  mounted() {
      this.init();
      this.animate();
  },
  created() {
    window.addEventListener('resize', this.handleResize)
  },
  destroyed() {
    window.removeEventListener('resize', this.handleResize)
  },
  beforeDestroy() {
      this.deconstruct();
  },
}
</script>

<style  lang="scss" scoped>

$blue: #51D4D4;
$brown: #C38200;

.Three-js-canvas {
  width: 100%;
  height: 100vh;
  position:relative;
  overflow: hidden;
	background: linear-gradient($blue, $brown);
}
</style>
