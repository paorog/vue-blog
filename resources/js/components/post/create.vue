<template>
    <div class="card mt-4">
        <div class="card-header">New Post</div>
        <div class="card-body">
            <div v-if=status_msg :class="{'alert-success': status, 'alert-danger': !status }" class="alert" role="alert">
                {{ status_msg }}
            </div>
            <form>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input v-model="title" type="text" class="form-control" id="title" placeholder="Post Title" required>
                </div>
                <div class="form-group">
                    <label for="body">Content</label>
                    <tinymce id="body" v-model="body"></tinymce>
                    <!-- <textarea v-model="body" type="text" class="form-control" id="body" placeholder="Post Content" required></textarea> -->
                </div>
                <div class="form-group">
                    <label for="title">Slug</label>
                    <input v-model="slug" type="text" class="form-control" id="slug" placeholder="Post Slug (eg. my-post-123)" required>
                </div>
            </form>
        </div>
        <div class="card-footer">
            <button type="button" @click="createPost" class="btn btn-success">
                {{ isCreatingPost ? 'Posting...' : 'Create Post' }}
            </button>
        </div>
    </div>
</template>
<script>
import { setTimeout } from 'timers';
import { mapState, mapActions } from 'vuex';
import tinymce from 'vue-tinymce-editor';

Vue.component('tinymce', tinymce);

export default {
  name: 'create-post',
  props: ['posts'],
  data() {
    return {
      dialogImageUrl: '',
      dialogVisible: false,
      imageList: [],
      status_msg: '',
      status: '',
      isCreatingPost: false,
      title: '',
      body: '',
      slug: '',
    };
  },
  computed: {
    ...mapActions(['getAllPosts']),
  },
  mounted() {
  },
  methods: {
    createPost(e) {
      e.preventDefault();
      if (!this.validateForm()) {
        return false;
      }
      this.isCreatingPost = true;
      let formData = new FormData();
      formData.append('title', this.title);
      formData.append('body', this.body);
      formData.append('slug', this.slug);
      axios.post('/post/create_post', formData)
        .then((res) => {
          this.title = this.body = this.slug = '';
          this.status = true;
          this.showNotification('Post Successfully Created');
          this.isCreatingPost = false;
          this.getAllPosts();
        });
    },
    validateForm() {
      if (!this.title) {
        this.status = false;
        this.showNotification('Title cannot be empty');
        return false;
      }
      if (!this.body) {
        this.status = false;
        this.showNotification('Content cannot be empty');
        return false;
      }
      if (!this.slug) {
        this.status = false;
        this.showNotification('Slug cannot be empty');
        return false;
      }
      else {
        axios.get(`/post/check_slug/${this.slug}`)
        .then((res) => {
          console.log(res.data.error);
          if(res.data.error === true) {
            this.status = false;
            this.showNotification('slug: '+this.slug+' is not available');
            return false;
          }
        })
      }
      

      return true;
    },
    showNotification(message) {
      this.status_msg = message;
      setTimeout(() => {
        this.status_msg = '';
      }, 3000);
    }
  },
};
</script>
