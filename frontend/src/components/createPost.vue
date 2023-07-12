<template>

    
    <form class="p-4">

        <div class="mb-3 mt-2">
            <label for="exampleInputEmail1" class="form-label">Title</label>
            <input type="text" v-model="name" class="form-control" id="exampleInputEmail1">
            <div id="emailHelp" class="form-text">Make it meaningful and short.</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Category</label>
            <input type="text" v-model="category" class="form-control" id="exampleInputPassword1">
            <div id="emailHelp" class="form-text">Select one.</div>

        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Tags</label>
            <input type="text" v-model="tags" class="form-control" id="exampleInputPassword1">
            <div id="emailHelp" class="form-text">You can select more than one.</div>
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Body</label>
            <textarea name="body" v-model="body" id="" class="form-control" cols="30" rows="10"></textarea>
        </div>

 
        <button type="submit" class="btn btn-outline-dark px-5">Create</button>
    </form>

                
    <!-- <div class="form-outline mb-4">

    <label class="form-label" for="form2Example27">Tags</label>
    <input type="text" id="form2Example27" list="tag_list" name="tags" class="form-control" placeholder="Separate with comma" />

    <datalist id="tag_list">
        <select id="tag_list">
        
        </select>
    </datalist>
    </div> -->

</template>



<script>
export default {
  data() {
    return {
      categories: [],
    };
  },
  mounted() {
    this.fetchCategories();
  },
  methods: {
    async fetchCategories() {
      try {
        const response = await fetch(`http://127.0.0.1:8000/api/categories}`);
        const data = await response.json();

        this.categories = data;
      } catch (error) {
        console.error(error);
      }
    },
  },
};
</script>