<template>
  <div id="left">
      <img :src="require('../images/hamburger.png').default" class="hamburger" />

      <div class="profile">
          <h1>Hi Favour</h1>
          <h2>Let's make project more amazing</h2>
      </div>

      <div class="search">
          <input type="text" placeholder="Search your project">

          <img :src="require('../images/search.png').default" />
      </div>

      <div class="project">
          <h3>Project <span>(18)</span></h3>
          <div class="projects">
          <div class="a-project">
              <div class="box-color">
                  <img :src="require('../images/overlay.png').default" />
                  <span>PT</span>
              </div>

              <h6>Development</h6>
          </div>
          <div class="a-project">
              <div class="box-color">
                  <img :src="require('../images/overlay.png').default" />
                  <span>PT</span>
              </div>

              <h6>Design</h6>
          </div>
          <div class="a-project">
              <div class="box-color">
                  <img :src="require('../images/overlay.png').default" />
                  <span>PT</span>
              </div>

              <h6>Testing</h6>
          </div>
          <div class="a-project">
              <div class="box-color">
                  <img :src="require('../images/overlay.png').default" />
                  <span>PT</span>
              </div>

              <h6>Medium Draft</h6>
          </div>
          <div class="a-project">
              <div class="box-color">
                  <img :src="require('../images/overlay.png').default" />
                  <span>PT</span>
              </div>

              <h6>Landing Page</h6>
          </div>
          <div class="a-project">
              <div class="box-color">
                  <img :src="require('../images/plus.png').default" />
                  <span>PT</span>
              </div>

              <h6>Add Projects</h6>
          </div>
          </div>
      </div>
  </div>
</template>

<script>
export default {

}
</script>

<style>

</style>
