<template>

    
    <form class="p-4">

        <div class="mb-3 mt-2">
            <label for="exampleInputEmail1" class="form-label">Title</label>
            <input type="text" v-model="name" class="form-control" id="exampleInputEmail1">
            <div id="emailHelp" class="form-text">Make it meaningful and short.</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label me-3">Category</label>
            <select  v-model="selectedOption">
              <option value="">Select an option</option>
              <option  v-for="category in categories" :value="category.id" :key="category.id">{{ category.name }}</option>
            </select>


        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Tags</label>
            <input type="text" id="form2Example27" list="tag-list" v-model="tags" class="form-control" placeholder="Separate with comma" />

              <datalist id="tag-list">
                <select id="tag-list">
                  <li v-for="category in categories" :key="category.id" >
                    <option value="`${category.name}`">{{category.name}}</option>
                  </li>

                </select>
              </datalist>
            <div id="emailHelp" class="form-text">You can select more than one.</div>
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Body</label>
            <textarea name="body" v-model="body" id="" class="form-control" cols="30" rows="10"></textarea>
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

    };
  },
  mounted() {
    this.fetchCategories()
 
  },
  methods: {

    async fetchCategories () {
      const categoryUrl = "http://127.0.0.1:8000/api/categories";

      try {
          const response = await fetch(categoryUrl);
          const data = await response.json();
  
          this.tags = data;
          console.log(data)

        } catch (error) {
          console.error(error);
        }


    },
    async fetchTags () {
      const categoryUrl = "http://127.0.0.1:8000/api/categories";

    try {
        const response = await fetch(categoryUrl);
        const data = await response.json();

        this.categories = data;
        console.log(data)

      } catch (error) {
        console.error(error);
      }
      
    },

    async createPost (event) {
        event.preventDefault();
        const article = {
            title:this.title, 
            category_id:this.category,
            user_id:localStorage.getItem("user"),
            body:this.body
          };

        const postUrl = "http://127.0.0.1:8000/api/create-post";
        const response = await fetch(postUrl, {
            method:"POST",
            headers:{
                'Content-Type': 'application/json',

            },
            body: JSON.stringify(article), // body data type must match "Content-Type" header

        });

        // const data = await response.json();

        if (!response.ok) 
        {
          console.log("Something went wrong")
            
        }

        else
        {
            this.$router.push({name:"home"});
        }

    }
    
  },
};
</script>
        
    