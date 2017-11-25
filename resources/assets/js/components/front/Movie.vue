<template>
	<div class="column is-one-quarter-tablet is-half-mobile">
        <a :href="/movie/ +  post.slug">
            <figure class="image is-16by9">
                <img :src="post.thumbnail.slug | FILE">
                <div class="preview">
                    <span v-if="post.sd" class="tag is-info">VIP</span>
                </div>
            </figure>
            <p>{{ post.title }}</p>
        </a>
    </div>
</template>

<script>
	export default {
		props: ['post']
	}
</script>