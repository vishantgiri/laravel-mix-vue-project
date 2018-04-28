<template>
  <div>
    <h2>User Details</h2>
	
    <form @submit.prevent="addUserDetails"  @submit="checkForm" class="mb-3">
	
	  <p v-if="errors.length">
    <b>Please correct the following error(s):</b>
    <ul>
      <li v-for="error in errors">{{ error }}</li>
    </ul>
  </p>
  
      <div class="form-group">
        <input type="text"  class="form-control" placeholder="Name" v-model="usersdetail.name">	
      </div>
	  <div class="form-group">
        <input type="text" class="form-control" placeholder="Phone" v-model="usersdetail.phone">	
      </div>
	  <div class="form-group">
        <input type="text" class="form-control" placeholder="Email" v-model="usersdetail.email">	
      </div>
	  <div class="form-group">
      
		<select class="form-control" placeholder="Gender" v-model="usersdetail.gender">
           <option disabled value="">Please select one</option>
           <option>Male</option>
           <option>Female</option>
        </select>
      </div>
	  <div class="form-group">
        <input type="date" class="form-control" placeholder="Date of Birth" v-model="usersdetail.dateofBirth">	
      </div>
	  <div class="form-group">
		<textarea class="form-control"  v-model="usersdetail.biography" placeholder="Add Your Biography"></textarea>
         		
      </div>
	  <div class="form-group">
     	
            <div class="col-md-2">
                <img :src="image" style="max-width:100px;" class="img-responsive">
            </div>
          <div class="col-md-12"> 
                <input type="file" ref="file" name="file" v-on:change="onFileChange" class="form-control" >
        </div>
      </div>
      <button type="submit" class="btn btn-light btn-block">Save</button>
    </form>

    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchUserDetails(pagination.prev_page_url)">Previous</a></li>

        <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a></li>
    
        <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchUserDetails(pagination.next_page_url)">Next</a></li>
      </ul>
    </nav> 
		   <table style="width:100%">
  <tr>
    <th style="width: 20%;" >Profile Picture</th>  
    <th>Name</th>
    <th>Phone</th>
    <th>Gender</th>
	<th>Date of Birth</th>
	<th>Email</th>
	<th>Biography</th>
	<th>Action</th>
  </tr>
  
   <tr  v-for="usersdetail in usersdetails" v-bind:key="usersdetail.id">
  
    <td style="width: 20%;"> <img v-bind:src="appStorage + usersdetail.profilepicture" style="width: 20%;" alt=""> </td>
    <td>{{ usersdetail.name }}</td>
    <td> {{ usersdetail.phone }} </td>
    <td> {{ usersdetail.gender }} </td>
    <td> {{ usersdetail.dateofBirth }} </td>
    <td> {{ usersdetail.email }} </td>
    <td> {{ usersdetail.biography }} </td>
	 <td> <button @click="editUserDetails(usersdetail)" class="btn btn-warning mb-2">Edit</button> <button @click="deleteUserDetails(usersdetail.id)" class="btn btn-warning mb-2">Delete</button></td>
  </tr>
 

	</table> 
	
  </div>
  
</template>

<script>

export default {
  data() {
    return {
		name:'',
		image:'',
      usersdetails: [],
      usersdetail: {
        id: '',
	    name: '',
        phone: '',
	    email: '',
	    gender: '',
	    dateofBirth: '',
	    biography: '',
		profilepicture: ''
      },
      usersdetail_id: '',
      pagination: {},
      edit: false,
	  errors:[]
    };
  },
  created() {
    this.fetchUserDetails();
  },
  

  methods: {
    fetchUserDetails(page_url) {
      let vm = this;
      page_url = page_url || (this.appUrl + 'api/usersdetails');
      fetch(page_url)
        .then(res => res.json())
        .then(res => {
          this.usersdetails = res.data;
          vm.makePagination(res.meta, res.links);
        })
        .catch(err => console.log(err));
    },
    makePagination(meta, links) {
      let pagination = {
        current_page: meta.current_page,
        last_page: meta.last_page,
        next_page_url: links.next,
        prev_page_url: links.prev
      };

      this.pagination = pagination;
    },
    deleteUserDetails(id) {
      if (confirm('Are You Sure?')) {
        fetch(this.appUrl + `api/usersdetail/${id}`, {
          method: 'delete'
        })
          .then(res => res.json())
          .then(data => {
            alert('User Removed');
            this.fetchUserDetails();
          })
          .catch(err => console.log(err));
      }
    },
	submitForm() {
            this.formData = new FormData();
            this.formData.append('name', this.usersdetail.name);
            this.formData.append('phone', this.usersdetail.phone);
            this.formData.append('gender', this.usersdetail.gender);
            this.formData.append('dateofBirth', this.usersdetail.dateofBirth);
            this.formData.append('email', this.usersdetail.email);
            this.formData.append('biography', this.usersdetail.biography);
            this.formData.append('image', this.usersdetail.profilepicture);
            if (this.edit === true) {
				this.formData.append('id', this.usersdetail.id);
			}
            axios.post(this.appUrl + 'api/usersdetail', this.formData, {headers: {'Content-Type': 'multipart/form-data'}})
				.then(data => {
					  if (this.edit === true) {
						alert('User Details Updated');
					  }else{
					  alert('User Details Added');
					  }
					 
             this.usersdetail.name = '';
			 this.usersdetail.phone = '';
             this.usersdetail.gender = '';
             this.usersdetail.dateofBirth = '';
             this.usersdetail.email = '';
             this.usersdetail.biography = '';
             this.usersdetail.profilepicture  = '';
			 this.usersdetail.id = null;
			 this.edit = false;
             this.image  = '';
			 const input = this.$refs.file;
			 input.type = 'text';
			 input.type = 'file';
					this.fetchUserDetails();
                })
                .catch(error => {
                  console.log(error)
                });
},
    addUserDetails() {
		if(this.errors.length == 0)
			this.submitForm();
    },
    editUserDetails(usersdetail) {
      this.edit = true;
      this.usersdetail.id = usersdetail.id;
      this.usersdetail.usersdetail_id = usersdetail.id;
	  this.usersdetail.name = usersdetail.name;
      this.usersdetail.phone = usersdetail.phone;
	  this.usersdetail.email = usersdetail.email;
	  this.usersdetail.gender = usersdetail.gender;
	  this.usersdetail.dateofBirth = usersdetail.dateofBirth;
	  this.usersdetail.biography = usersdetail.biography;
	  this.image = this.appStorage + usersdetail.profilepicture;
    },
	checkForm:function(e) {
      this.errors = [];
     if(!this.usersdetail.name) this.errors.push("Name required.");
	 
	  if(!this.usersdetail.phone) {
        this.errors.push("Phone required.");
      } else if(!this.validPhone(this.usersdetail.phone)) {
        this.errors.push("Please Enter Your 10 Digits Phone Number.");        
      }
	  
	  if(!this.usersdetail.email) {
        this.errors.push("Email required.");
      } else if(!this.validEmail(this.usersdetail.email)) {
        this.errors.push("Valid email required.");        
      }
	  if(!this.usersdetail.gender) this.errors.push("Gender required.");
	  if(!this.usersdetail.dateofBirth) this.errors.push("Date of Birth required.");
      if(!this.usersdetail.biography) this.errors.push("Biography required.");
      e.preventDefault();
    },
    validEmail:function(email) {
      var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    },
	validPhone:function(phone) {
      var re = /^\d{10}$/;
      return re.test(phone);
    },
	onFileChange(e) {
		let files = e.target.files || e.dataTransfer.files;
		if (!files.length)
			return;
		 this.usersdetail.profilepicture = files[0];
		 this.createImage(files[0]);
		
	},
	createImage(file) {
		let reader = new FileReader();
		let vm = this;
		reader.onload = (e) => {
			vm.image = e.target.result;
		};
		reader.readAsDataURL(file);
	}
  }
};
</script>