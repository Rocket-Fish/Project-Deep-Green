<template>
  <div>
    <vue-headful title="Deep Green Ocean"/>
    <div id="Three-js-canvas" style="background-color:red; width: 100%; height: 100vh; position:relative; overflow: hidden;">
      <div style="position: absolute; color:white; width:100%; height:100%">
        <div class="container vertical-align" style="height:100%">
          <router-view></router-view>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import * as Three from 'three';
export default {

  data() {
    return {
      camera: null,
      scene: null,
      renderer: null,
      mesh: null,
      Three: Three
    }
  },
  methods: {
    init() {
        let container = document.getElementById('Three-js-canvas');

        this.camera = new Three.PerspectiveCamera(70, container.clientWidth/container.clientHeight, 0.01, 10);
        this.camera.position.z = 1;

        this.scene = new Three.Scene();

        this.light = new Three.DirectionalLight( 0xffffff );
        this.light.position.set( 0, 1, 1 ).normalize();
        this.scene.add(this.light);

        let geometry = new Three.BoxGeometry(0.2, 0.2, 0.2);
        let material = new Three.MeshPhongMaterial({ color: 0x0033ff, specular: 0x555555, shininess: 30 });

        this.mesh = new Three.Mesh(geometry, material);
        this.scene.add(this.mesh);

        this.renderer = new Three.WebGLRenderer({antialias: true});
        this.renderer.setClearColor("#000000");
        this.renderer.setSize(container.clientWidth, container.clientHeight);
        container.appendChild(this.renderer.domElement);

        this.handleResize();
    },
    animate() {
        requestAnimationFrame(this.animate);
        this.mesh.rotation.x += 0.01;
        this.mesh.rotation.y += 0.02;
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

<style scoped>
</style>
