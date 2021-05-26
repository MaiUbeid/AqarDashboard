<template>
  <div>
    <p style="display: none">
      <router-link :to="{ name: 'home' }">Home</router-link> |
      <router-link :to="{ name: 'hello' }">Hello World</router-link>
      <router-link :to="{ name: 'images.store.index' }">مخزن الصور</router-link>

    </p>

    <div class="container">
      <router-view>

      </router-view>
    </div>
  </div>
</template>
<script>
  export default {
    created() {



          const path = `/panel/admin/image_store_with_vue/store`;
          if (this.$route.path !== path) this.$router.push(path)
          //  this.setData([],{data: this.images, links:this.links, meta:this.meta});
          // this.goToNext();
          //this.goToPrev();
          /* const path = `users`
           if (this.$route.path !== path) this.$router.push(path)*/

    },
  }
</script>
