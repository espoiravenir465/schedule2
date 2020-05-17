<template>
<div class="photo">
    <figure class="photo__wrapper">
        <img class="photo__image" :src="item.data">
    </figure>
</div>
</template>

<script>
export default {
    props: {
        item: {
            type: Object,
            required: false
        }
    }
}
</script>
