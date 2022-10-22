<template>
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-12">
        <h4 class="mb-5">Laravel Vue SPA - shouts.dev</h4>
        <table id="table" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Email</th>
            <th class="check">Action
              <a data-toggle="modal" data-target="#user"
                 style="float: right;cursor: pointer; color: white; padding: 2px;"
                 @click="openModalWindow" class="btn btn-sm btn-warning py-0">
                <i class="fa fa-plus-square"> Add User
                </i>
              </a>
            </th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="user in users.data" :key="user.id">
            <td><img width="80" :src="user.profile_pic" :alt="user.name"></td>
            <td>{{ user.name }}</td>
            <td>{{ user.email }}</td>
            <td class="check">
              <a title="Edit category" class="btn btn-sm btn-dark py-0"
                 style="color:white;cursor: pointer;" @click="edit(user)">Edit</a>
              <a class="btn btn-sm btn-danger py-0" @click="deleteUser(user.id)" style="color:white;">Delete</a>
            </td>
          </tr>
          </tbody>
          <pagination :data="users" @pagination-change-page="getResults"></pagination>
        </table>
        <div class="modal fade" id="user" tabindex="-1" role="dialog" aria-labelledby="addNewLabel"
             aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 v-if="form.id" class="modal-title">Update User</h5>
                <h5 v-else class="modal-title">Add New User</h5>
              </div>

              <form @submit.prevent="form.id ? updateUser() : createUser()">
                <div class="modal-body">
                  <div class="form-group">
                    <input v-model="form.name" type="text" name="name"
                           placeholder="Name"
                           class="input2 form-control" :class="{ 'is-invalid': errors.name }"
                           data-validate="User name is required">
                    <span class="focus-input2" data-placeholder="Company Name"></span>
                    <span class="text-danger" v-if="errors.name">{{ errors.name[0] }}</span>
                  </div>
                  <div class="form-group">
                    <input v-model="form.email" type="text" name="email"
                           placeholder="Email"
                           class="input2 form-control" :class="{ 'is-invalid': errors.email }"
                           data-validate="User Email is required">
                    <span class="focus-input2" data-placeholder="User Email"></span>
                    <span class="text-danger" v-if="errors.email">{{ errors.email[0] }}</span>
                  </div>
                  <div class="form-group">
                    <input v-model="form.password" type="password" name="password"
                           placeholder="password"
                           class="input2 form-control" :class="{ 'is-invalid': errors.password }"
                           data-validate="Password is required">
                    <span class="focus-input2" data-placeholder="Password"></span>
                    <span class="text-danger" v-if="errors.password">{{ errors.password[0] }}</span>
                  </div>
                  <div class="form-group">
                    <input v-model="form.password_confirmation" type="password" name="password"
                           placeholder="password"
                           class="input2 form-control" :class="{ 'is-invalid': errors.password_confirmation }"
                           data-validate="Password is required">
                  </div>
                  <div class="form-group">
                    <input type="file" class="input2 form-control" @change="imageUp">
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  <button v-if="form.id" type="submit" class="btn btn-success">Update</button>
                  <button v-else type="submit" class="btn btn-success">Create</button>
                </div>

              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>


export default {

  data() {
    return {
      users: {},
      errors: [],
      form: {
        id: '',
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        image: '',
      },
    }
  },
  methods: {
    resetForm() {
      for (var key in this.form) {
        this.form[key] = '';
      }
      this.errors = [];
    },
    openModalWindow() {
      this.resetForm();
      $('#user').modal('show');
    },
    getUsers() {
      axios.get("/users").then(data => (this.users = data.data.users));
    },
    getResults(page = 1) {
      axios.get('/users?page=' + page)
          .then(response => {
            this.users = response.data.users;
          });
    },
    createUser() {
      axios.post('/users', this.createFormData(), {
        headers: {
          'Content-Type': "multipart/form-data; charset=utf-8; boundary=" + Math.random().toString().substr(2)
        }
      }).then(() => {
            Fire.$emit('load_user');
            Toast.fire({
              icon: 'success',
              title: 'User created successfully'
            });
            $('#user').modal('hide');
          })
          .catch((error) => {
            console.log("Error......");
            if (error.response.status == 422) {
              this.errors = error.response.data.errors;
            }
          })
    },
    createFormData() {
      let formData = new FormData();

      for (var key in this.form) {
        formData.append(key, this.form[key]);
      }
      return formData;
    },
    edit(user) {
      this.resetForm();
      $('#user').modal('show');
      this.form = user;
    },
    updateUser() {
      axios.post('/users/' + this.form.id, this.createFormData(), {
        headers: {
          'Content-Type': "multipart/form-data; charset=utf-8; boundary=" + Math.random().toString().substr(2)
        }
      }).then(() => {

            Toast.fire({
              icon: 'success',
              title: 'User updated successfully'
            })

            Fire.$emit('load_user');

            $('#user').modal('hide');
          })
          .catch((error) => {
            console.log("Error.....");
            if (error.response.status == 422) {
              this.errors = error.response.data.errors;
            }
          })
    },
    deleteUser(id) {
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {

        if (result.value) {

          axios.delete('/users/' + id)
              .then((response) => {
                Swal.fire(
                    'Deleted!',
                    'User deleted successfully',
                    'success'
                )

                Fire.$emit('load_user');

              }).catch(() => {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Something went wrong!',
            })
          })
        }

      })
    },
    imageUp() {
      this.form.image = event.target.files[0];
    }
  },
  created() {

    this.getUsers();

    Fire.$on('load_user', () => {
      this.getUsers();
    });

  },

}
</script>

<style scoped>
.pagination {
  margin-top: 30px;
  float: right;
}

.validation_error {
  border: 1px solid red !important;
}
</style>
