<template>
    <div id="Three-js-canvas" class= "Three-js-canvas">
      <div style="position: absolute; color:white; width:100%; height:100%">
          <component :is="child_component"></component>
      </div>
  </div>
</template>
<script>
    import * as THREE from 'three';

    const colors = {
        white:0xffffff,
        fog:0xf0f0f0,
        water:0x00C6C6,
    }

    class Bubble {
        constructor(radius) {
            let geom = new THREE.SphereGeometry(radius, 24, 24);
            let scene = scene;
            // create a material; a simple white material will do the trick

            // make a material
            let mat = new THREE.MeshPhongMaterial({
              color:colors.white,
              transparent:true,
              opacity:.3,
              flatShading:true,
            });
            this.mesh = new THREE.Mesh(geom, mat);
            // allow each bubble to cast and to receive shadows
            this.mesh.castShadow = true;
            this.mesh.receiveShadow = true;
        }
    }

    class World {
        constructor(radius) {
            // create mesh
            this.mesh = new THREE.Object3D();

            // number of bubbles;
            this.nBubbles = 20;

            // somewhat even distribution of bubbles
            let stepAngle = Math.PI*2/this.nBubbles;

            // create the nBubbles
            for(let i = 0; i < this.nBubbles; i ++) {
                // make the radius random between 1 and 19.
                // b/c random() generates a num in [0,1)
                let r = 10+Math.ceil(Math.random()*20);
                let b = new Bubble(r);

                // angle at which the bubble will be placed
                let a = stepAngle*i;
                // radius at which the bubble will be placed
                let h = radius + Math.random()*200;

                b.mesh.position.y = Math.sin(a)*h;
                b.mesh.position.z = Math.cos(a)*h;

                b.mesh.position.x = -50+Math.random()*100;

                // combine the mesh of the bubble into the world
                this.mesh.add(b.mesh);
            }

        }
    }

    export default {
        props: {
            child_component:Object,
        },
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

                world: null,

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

                this.createWorld(100);

                this.handleResize();
            },
            createWorld(worldRadius) {
                this.world = new World(worldRadius);
                this.world.mesh.position.y = -worldRadius+50;
                this.scene.add(this.world.mesh);
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
                this.camera.position.z = 0;
                this.camera.position.y = 0;

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
            animate() {
                this.requestedAnimationFame = requestAnimationFrame(this.animate);
                // the z axix is the axis facing us.
                this.world.mesh.rotation.x += 0.0015;
                this.renderer.render(this.scene, this.camera);
            },
            handleResize() {
              this.camera.aspect = window.innerWidth / window.innerHeight
              this.camera.updateProjectionMatrix()
              // *0.99 width because to remove the side scrolling bar
              this.renderer.setSize(window.innerWidth, window.innerHeight)
            },
            deconstruct() {
                // unallocate stuff here to avoid memory leaks
                // set unused resources to null, for js GC to collector
                // and stop animations, if any
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

                this.world = null;
            },
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
<style lang="scss" scoped>

$blue: #00C6C6;

.Three-js-canvas {
    width: 100%;
    height: 100vh;
    position:relative;
    overflow: hidden;
    background: linear-gradient(to top right, $blue, #FFF);
}
</style>
