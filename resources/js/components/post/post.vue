<template>
<div>
    <div class="col-md-12">
        <h2>{{ post.title }}</h2> <br>
        <span><strong>Posted By:</strong> {{user.name}} - {{post.created_at | moment("from", "now")}}</span>
    </div class="col-md-12">
    <hr />

    <div class="col-md-12" v-html="post.body">
        {{post.body}}
    </div>
    
</div>
</template>
<script>
import { mapState } from 'vuex';

export default {
    name: 'view-post',
    props: ['post', 'user'],
    // data() {
    //     return {
    //         currentPost: '',
    //     };
    // },
    // computed: {
    //     ...mapState(['posts'])
    // },
    // beforeMount() {
    //     this.$store.dispatch('getAllPosts');
    // },
    // methods: {
    //     baseurl(){
    //         var baseurl = window.location.href;
    //         return baseurl;
    //     },
    //     truncateText(text) {
    //         if (text.length > 24) {
    //             return `${text.substr(0, 24)}...`;
    //         }
    //         return text;
    //     },
    //     viewPost(postIndex) {
    //         const post = this.posts[postIndex];
    //         this.currentPost = post;
    //         this.postDialogVisible = true;
    //     },
    //     viewPostBySlug(postSlug) {
    //         console.log(postSlug);
    //     },
        
    // },
}
</script>