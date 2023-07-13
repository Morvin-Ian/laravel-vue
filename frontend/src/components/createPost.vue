<style>
  /* Style for the tag list container */
  #tag_list {
    margin-top: 5px;
  }

  /* Style for each individual tag */
  #tag_list ul {
    list-style: none;
    padding: 0;
    margin: 0;
    display: inline-block;
    background-color: #e9ecef;
    padding: 5px 10px;
    border-radius: 5px;
    margin-right: 5px;
    margin-bottom: 5px;
  }

  /* Style for the tag text */
  #tag_list ul li {
    display: inline-block;
    margin-right: 5px;
    color: #333;
    font-size: 14px;
    cursor: pointer;
  }

  /* Style for the tag input */
  input[type="text"] {
    width: 100%;
    padding: 5px 10px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
  }
</style>

<template>

    
    <form class="p-4" method="post" @submit="createPost">

        <div class="mb-3 mt-2">
            <label for="exampleInputEmail1" class="form-label">Title</label>
            <input type="text" v-model="title" class="form-control" id="exampleInputEmail1" required>
            <div id="emailHelp" class="form-text">Make it meaningful and short.</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label me-3">Category</label>
            <select  v-model="category" required>
              <option  v-for="category in categories" :value="category.id" :key="category.id">{{ category.name }}</option>
            </select>
        </div>

        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Tags</label>
          <input type="text" id="tag-text" list="tag_list" v-model="tag" class="form-control" placeholder="Must be separated with comma" required/>
          <div id="tag_list">
            <ul  v-for="tag in tags" :value="tag.name" :key="tag.id">
              <li @click="addTag(tag.name)">
                {{ tag.name }} 
                
              </li>
            </ul>
          </div>
          <div id="emailHelp" class="form-text">You can select more than one.</div>
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Body</label>
            <textarea name="body" v-model="body" id="" class="form-control" cols="30" rows="10" required></textarea>
        </div>
 
        <button type="submit" class="btn btn-outline-dark px-5">Create</button>
    </form>

</template>



<script>


  export default {
  data() {
    return {
      categories: [],
      tags: [],
      tag:''

    };
  },
  mounted() {
    const user = localStorage.getItem("access_token");
    if(!user)
    {
      this.$router.push({name:"login"});
    }


    this.fetchCategories();
    this.fetchTags();

  },
  methods: {

    async fetchCategories () {
      const categoryUrl = "http://127.0.0.1:8000/api/categories";

      try {
          const response = await fetch(categoryUrl);
          const data = await response.json();
  
          this.categories = data;

        } catch (error) {
          console.error(error);
        }


    },


    async fetchTags () {
      const tagUrl = "http://127.0.0.1:8000/api/tags";

      try {
          const response = await fetch(tagUrl);
          const data = await response.json();

          this.tags = data

        } catch (error) {
          console.error(error);
        }
      
    },

    addTag(clickedTag) {
        if (this.tag) {
          this.tag += ', '; 
        }
        this.tag += clickedTag; 
      },

    async createPost (event) {
        event.preventDefault();
        const article = {
            title:this.title, 
            tags:this.tag,
            slug:this.title.toLowerCase(),
            category_id:this.category.toString(),
            user_id:localStorage.getItem("user"),
            body:this.body
          };

        console.log( JSON.stringify(article))

        const postUrl = "http://127.0.0.1:8000/api/create-post";
        const response = await fetch(postUrl, {
            method:"POST",
            headers:{
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(article), // body data type must match "Content-Type" header

        });

        const data = await response.json();

        if (!response.ok) 
        {
          console.log("Something went wrong")
            
        }

        else
        {
          console.log(data)
            this.$router.push({name:"home"});
        }

    }
    
  },
};
</script>
        
    