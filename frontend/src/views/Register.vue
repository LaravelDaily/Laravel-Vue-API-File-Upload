<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Register</div>

          <div class="card-body">

            <div v-if="errors">
              <div v-for="error in errors" class="alert alert-danger">{{ error }}</div>
            </div>

            <form v-if="showForm">

              <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                <div class="col-md-6">
                  <input v-model="formData.name" id="name" type="text" class="form-control" name="name" required autocomplete="name" autofocus>
                </div>
              </div>

              <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                <div class="col-md-6">
                  <input v-model="formData.email" id="email" type="email" class="form-control" name="email" required autocomplete="email">
                </div>
              </div>

              <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                <div class="col-md-6">
                  <input v-model="formData.password" id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
                </div>
              </div>

              <div class="form-group row">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm password</label>

                <div class="col-md-6">
                  <input v-model="formData.password_confirmation" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
              </div>


              <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Avatar</label>
                <div class="col-md-6">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="customFile" ref="file" @change="handleFileObject()">
                    <label class="custom-file-label text-left" for="customFile">{{ avatarName }}</label>
                  </div>
                </div>
              </div>

              <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                  <button @click.prevent="submit" type="submit" class="btn btn-primary" style="background: #42b983; border: #42b983;">
                    Register
                  </button>
                </div>
              </div>
            </form>
            <div v-if="user">
              <div class="alert alert-success">User created</div>
              <div>
                <img height="100px" width="auto" :src="user.avatar_url" alt="">
              </div>
              <div>Name : {{ user.name }}</div>
              <div>Email : {{ user.email }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>

  import axios from 'axios'
  import _ from 'lodash'

  export default {
    data() {
      return {
        formData: {
          name: null,
          email: null,
          password: null,
          password_confirmation: null,
        },
        avatar: null,
        avatarName: null,
        showForm: true,
        user: null,
        errors: null,
      }
    },
    methods: {
      submit() {
        this.errors = null

        let formData = new FormData()
        formData.append('avatar', this.avatar)

        _.each(this.formData, (value, key) => {
          formData.append(key, value)
        })


        axios.post('/api/register', formData, {
            headers: {
              'Content-Type': "multipart/form-data; charset=utf-8; boundary=" + Math.random().toString().substr(2)
            }
          }
        ).then(response => {
          this.showForm = false
          this.user = response.data.data
        }).catch(err => {
          if (err.response.status === 422) {
            this.errors = []
            _.each(err.response.data.errors, error => {
              _.each(error, e => {
                this.errors.push(e)
              })
            })

          }
        });
      },
      handleFileObject() {
        this.avatar = this.$refs.file.files[0]
        this.avatarName = this.avatar.name
      }
    }

  }

</script>
