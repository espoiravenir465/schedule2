<template>
<div class="top">
　<div class="title">
  <p>Bon voyage!</p>
   <RouterLink class="button button--link" to="/login">
         まずはこちらから！
      </RouterLink>
  </div>
  <div class="explain">
  <p>ようこそBon Voyage!へ</p>
　<p>旅のスケジュール管理アプリです。</p>
　<p>旅のしおりとして、旅の思い出の記録として</p>
　<p>自由にお使い下さい</p>
　</div>
　</div>
</template>

<script>
export default {
  computed: {
    isLogin () {
      return this.$store.getters['auth/check']
    }
  }
}
</script>