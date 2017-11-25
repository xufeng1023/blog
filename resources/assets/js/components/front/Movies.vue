<template>
	<div class="columns is-mobile is-multiline" v-if="posts.length">
        <movie v-for="post in posts" :key="post.id" :post="post"></movie>
        <div class="column is-12" v-if="more">
        	<div class="has-text-centered">
        		<a href="#" @click.prevent="page++">{{ moreText }}</a>
        	</div>
        </div>
    </div>
</template>

<script>
	import movie from './Movie.vue';
	export default {
		components: {movie},
		data() {
			return {
				posts: [],
				lastPage: null,
				page: 1,
				more: true,
				moreText: window.lan.more
			}
		},
		created() {
			this.fetch();
			document.addEventListener("scroll", this.updatePage, false);
		},
		watch: {
			page() {
				this.fetch();
			}
		},
		methods: {
			fetch() {
				axios.get('/movies?page='+this.page)
				.then(({data}) => {
					if(!this.lastPage) {
						this.lastPage = data.last_page;
					}
					if(this.page === this.lastPage) {
						this.more = false;
					}
					data.data.forEach(value => {
						this.posts.push(value);
					});
				})
			},
			updatePage() {
				if(this.page >= this.lastPage) return;
				if ((window.innerHeight + window.scrollY) == document.body.offsetHeight) {
			        this.page++;
			    }
			}
		}
	}
</script>
