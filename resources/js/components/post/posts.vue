<template>
    <div class="row">

        <div class="col-md-12" v-for="(post, i) in posts" :key=i>
            <div class="card mt-4">
                <div class="card-body">
                    <p class="card-text"><strong>{{ post.title }}</strong> <br>
                        <span v-html="truncateText(post.body)"></span> <br>
                        <a href="javascript:" @click="viewPost(post.slug)"><i>{{ baseurl() }}/post/view_post/{{post.slug}}</i></a> <br> <br>
                        <strong>Posted By:</strong> {{ post.author }} - {{post.date | moment("from", "now")}}
                    </p>
                </div>
                
                <button class="btn btn-success m-2" @click="viewPost(post.slug)"> View Post</button>
            </div>
        </div>

    </div>
</template>
<script>
import { mapState } from 'vuex';

export default {
    name: 'all-posts',
    data() {
        return {
            postDialogVisible: false,
            currentPost: '',
        };
    },
    computed: {
        ...mapState(['posts'])
    },
    beforeMount() {
        this.$store.dispatch('getAllPosts');
    },
    methods: {
        baseurl(){
            var baseurl = window.location.origin;
            return baseurl;
        },
        truncateText(text) {
            if (text.length > 128) {
                return `${text.substr(0, 128)}...`;
            }
            return text;
        },
        viewPost(postSlug) {
            window.location.href = `/post/view_post/${postSlug}`;
        },
        
    },
}
</script>