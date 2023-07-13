<template>
    
    <section class="h-100 bg-light">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col">
          <div class="card card-registration my-4">
            <div class="row g-0">
              <div class="col-xl-6 d-none d-xl-block">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/img4.webp"
                  alt="Sample photo" class="img-fluid"
                  style="border-top-left-radius: .25rem; border-bottom-left-radius: .25rem;" />
              </div>
              <div class="col-xl-6">
                <div class="card-body p-md-5 text-black">
                  <h3 class="mb-5 text-uppercase">Register Your Account</h3>


  
                  <form class='m-5 ps-5 pe-5'  method="POST" @submit="RegisterUser">
                    <p class="mb-3" style="color: red;" id="message"></p>

                    <div class="form-outline mb-4">
                   
                        <input type="name" id="form3Example9" v-model="name" required class="form-control form-control-lg"  />
                        <label class="form-label" for="form3Example9">Username</label>
                      </div>

                    <div class="form-outline mb-4">
             
                        <input type="email" id="form3Example9" v-model="email" required class="form-control form-control-lg"  />
                        <label class="form-label" for="form3Example9">Email</label>
                    </div>
    
                
                    <div class="form-outline mb-4">
            
                        <input type="password" id="form3Example9" v-model="password" required class="form-control form-control-lg" />
                        <label class="form-label" for="form3Example9">Password</label>
                    </div>
  
                    <div class="form-outline mb-4">
                
                        <input type="password" v-model="password_confirmation" id="form3Example97"  required class="form-control form-control-lg" />
                        <label class="form-label" for="form3Example97">Password Confirmation</label>
                    </div>
    
                    <div class="d-flex justify-content-end pt-3">
                        <button type="submit" class="btn btn-dark w-100 btn-lg ms-2 mb-2 text-light">Register</button>
                    </div>

                    <a class="small text-muted" href="#!">Forgot password?</a>
                  <p class="mb-5 pb-lg-2" style="color: #393f81;">Already have an account? <a href="/sign-in"
                      style="color: #393f81;">Login here</a></p>
                  <a href="#!" class="small text-muted">Terms of use.</a>
                  <a href="#!" class="small text-muted">Privacy policy</a>

                </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

</template>
    

<script>

export default {
data() {
  return {
    post: [],
  };
},
mounted() {

},
methods: {

  async RegisterUser (event) {
      event.preventDefault();
      const credentials = {name: this.name, email:this.email, password:this.password};
      const loginUrl = "http://127.0.0.1:8000/api/register";
      const error = document.getElementById("message")


      if(this.password_confirmation !== this.password)
      {
          error.innerHTML = "Passwords do not match"
      }

      else{
          const response = await fetch(loginUrl, {
            method:"POST",
            headers:{
                'Content-Type': 'application/json',

            },
            body: JSON.stringify(credentials), // body data type must match "Content-Type" header

          });

          const data = await response.json();


          if (!response.ok) 
          {
            error.innerHTML = data.message
          }

          else
          {
        
              this.$router.push({name:"login"});

          }

      }


  }



  
},
};
</script>
      
  
