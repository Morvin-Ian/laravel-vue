<template> 
    <div class="blog">
      <div class="d-flex m-5">
        <input class="form-control text-center" type="search" v-model="searchQuery" @keypress="resultQuery" placeholder="Search for Posts" aria-label="Search">
      </div>
    <ul class="blog-posts">
      <li v-for="post in paginatedItems" :key="post.id" class="blog-post">
        <h3 class="post-title">
          <router-link :to="`/post/${post.post.id}`" class="post-link">{{ post.post.title }}</router-link>
        </h3>
        <p class="post-author">
          By <router-link :to="`/author/${post.author.name}`" class="author-link">{{ post.author.name }}</router-link>
        </p>
        <p class="post-category">
          Category: <router-link :to="`/category/${post.category.name}`" class="category-link">{{ post.category.name }}</router-link>
        </p>
        <ul class="post-tags">
          <li v-for="tag in post.tags" :key="tag.id">
            <router-link :to="`/tag/${tag.name}`" class="tag-link">{{ tag.name }}</router-link>
          </li>
        </ul>
        <p class="post-body">{{ truncateText(post.post.body, 200) }}</p>
        <hr class="post-divider">
      </li>
    </ul>
    <div class="pagination-controls">
      <button @click="previousPage" :disabled="currentPage === 1" class="pagination-button">Previous</button>
      <button v-for="page in totalPages" :key="page" @click="goToPage(page)" class="pagination-button" :class="{ active: page === currentPage }">
        {{ page }}
      </button>
      <button @click="nextPage" :disabled="currentPage === totalPages" class="pagination-button">Next</button>
    </div>
  </div>
  </template>


  <script>
  import '../assets/css/style.css'
  
  export default {
    data() {
      return {
        posts: [],
        currentPage: 1, 
        postsPerPage: 2, 
        searchQuery:''
      };
    },

    
    mounted() {
      this.fetchPosts();
    },


    methods: {
      async fetchPosts() {
        try {
          const response = await fetch('http://127.0.0.1:8000/api/posts');
          const data = await response.json();
  
          this.posts = data;

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

      nextPage() {
        if (this.currentPage < this.totalPages) {
          this.currentPage++;
        }
      },

      previousPage() {
        if (this.currentPage > 1) {
          this.currentPage--;
        }
      },

      goToPage(pageNumber) {
        if (pageNumber >= 1 && pageNumber <= this.totalPages) {
          this.currentPage = pageNumber;
        }
      },

      resultQuery(){
        if(this.searchQuery){
          let matchedPosts =  this.posts.filter((item)=>{
            const query = this.searchQuery.toLowerCase();
            const titleMatch = item.post.title.toLowerCase().includes(query);
            const categoryMatch = item.category.name.toLowerCase().includes(query);
            const tagMatch = item.tags.some((tag) => tag.name.toLowerCase().includes(query));
            
            return titleMatch || categoryMatch || tagMatch;    
          })
          
          const unmatchedPosts = this.posts.filter((item) => !matchedPosts.includes(item));

          // Concatenate matched posts with unmatched posts
          const sortedPosts = matchedPosts.concat(unmatchedPosts);

          this.posts =  sortedPosts;
        }else{
          return this.posts;
        }
      }
    },


    computed: {
      startIndex() {
        return (this.currentPage - 1) * this.postsPerPage;
      },
      endIndex() {
        return this.startIndex + this.postsPerPage - 1;
      },
      paginatedItems() {
        return this.posts.slice(this.startIndex, this.endIndex + 1);
      },
      totalPages() {
        return Math.ceil(this.posts.length / this.postsPerPage);
      },
    },
  };
  </script>

  