<template>
    <div class="mt-4">
        <ul>
          <li v-for="post in post" :key="post.id">
            <h3 >{{ post.post.title }}</h3>
            <p >Author: <router-link :to="`/author/${post.author.name}`"> {{ post.author.name }}</router-link></p>
            <p>Category: <router-link :to="`/category/${post.category.name}`"> {{ post.category.name }}</router-link></p>
            
            <p>Tags: 
                <ul style="display: inline;" v-for="tag in post.tags" :key="tag.id" >
                <router-link :to="`/tag/${tag.name}`"> {{  tag.name }}</router-link>
                </ul>
            </p>

            <p>{{ truncateText(post.post.body, 150) }}</p>
          </li>
        </ul>
      </div>
  </template>

  
  <script>


  export default {
    
    
    data() {
      return {
        post: [],
      };
    },
    mounted() {
      this.fetchPost();
      this.id = this.$route.params.id;
    },
    methods: {
      async fetchPost() {
        try {
          const response = await fetch(`http://127.0.0.1:8000/api/tag/${this.$route.params.slug}`);
          const data = await response.json();
  
          this.post = data;
        } catch (error) {
          console.error(error);
        }
      },
      truncateText(text, maxLength) {
      if (text.length <= maxLength) {
        return text;
      } else {
        return text.substr(0, maxLength).trim() + '...';
      }
    },
    },
  };
  </script>