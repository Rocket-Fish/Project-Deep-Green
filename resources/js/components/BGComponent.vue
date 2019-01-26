<template>
  <div>
    <vue-headful title="Deep Green Ocean"/>
    <div id="Three-js-canvas" class= "Three-js-canvas">
      <div style="position: absolute; color:white; width:100%; height:100%">
        <div class="container vertical-align" style="height:100%">
          <router-view></router-view>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import * as THREE from 'three';

const colors = {
  water:0x00C6C6,
  sand:0xC38200,
  fog:0xC38200
};


class Sea {
  constructor() {
    this.geom = new THREE.CylinderGeometry(600,600,800,40,10);
    // rotate the geometry on the x axis
    this.geom.applyMatrix(new THREE.Matrix4().makeRotationX(-Math.PI/2));
    // make a material
    let mat = new THREE.MeshPhongMaterial({
      color:colors.water,
      transparent:true,
      opacity:.6,
      flatShading:true,
    });

    // To create an object in Three.js, we have to create a mesh
    // which is a combination of a geometry and some material
    this.mesh = new THREE.Mesh(this.geom, mat);

    // Allow the sea to receive shadows
    this.mesh.receiveShadow = true;
  }
}

export default {
  data() {
    return {
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

      colors: colors
    }
  },
  methods: {
    init() {
        // make scene

        this.createScene();
        // add lightings
        this.createLights();

        // create objects like sky and sea
        this.createSea();
        this.createSky();


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
    },
    createSea() {
      // make a new sea object
      this.sea = new Sea();

      // sea position
      this.sea.mesh.position.y = -550;

      // add sea to scene
      this.scene.add(this.sea.mesh);
    },
    createSky() {

    },
    animate() {
        requestAnimationFrame(this.animate);
        // rotate the sea about the z axis (remember we rotated it during creation)
        this.sea.mesh.rotation.z += 0.003;
        this.renderer.render(this.scene, this.camera);
    },
    handleResize() {
      this.camera.aspect = window.innerWidth / window.innerHeight
      this.camera.updateProjectionMatrix()
      // *0.99 width because to remove the side scrolling bar
      this.renderer.setSize(window.innerWidth, window.innerHeight)
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
