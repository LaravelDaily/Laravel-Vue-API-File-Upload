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
                <label for="name" class="col-md-4 col-form-label text-md-right">Title</label>

                <div class="col-md-6">
                  <input v-model="formData.title" id="name" type="text" class="form-control" name="name" required autocomplete="name" autofocus>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Text</label>

                <div class="col-md-6">
                  <textarea v-model="formData.content" rows="5" class="form-control"></textarea>
                </div>
              </div>


              <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Thumbnail</label>
                <div class="col-md-6">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="customFile" ref="file" @change="handleFileObject()">
                    <label class="custom-file-label text-left" for="customFile">{{ thumbName }}</label>
                  </div>
                </div>
              </div>

              <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                  <button @click.prevent="submit" type="submit" class="btn btn-primary" style="background: #42b983; border: #42b983;">
                    Create
                  </button>
                </div>
              </div>
            </form>
            <div v-if="article">
              <div class="alert alert-success">Article created</div>
              <div>
                <img height="100px" width="auto" :src="article.thumbnail_url" alt="">
              </div>
              <div>Title : {{ article.title }}</div>
              <div>Content : {{ article.content }}</div>
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
          title: null,
          content: null,
        },
        thumbnail: null,
        thumbName: null,
        showForm: true,
        article: null,
        errors: null,
      }
    },
    methods: {
      submit() {
        this.errors = null

        let formData = new FormData()
        formData.append('thumbnail', this.thumbnail)

        _.each(this.formData, (value, key) => {
          formData.append(key, value)
        })

        axios.post('/api/articles', formData, {
            headers: {
              'Content-Type': "multipart/form-data; charset=utf-8; boundary=" + Math.random().toString().substr(2)
            }
          }
        ).then(response => {
          this.showForm = false
          this.article = response.data.data
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
        this.thumbnail = this.$refs.file.files[0]
        this.thumbName = this.thumbnail.name
      }
    }

  }

</script>
