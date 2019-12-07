<template>
  <div class="schedule-list">
    <div class="grid">
      <Photo
        class="grid__item"
        v-for="schedule in scheules"
        :key="id"
        :item="schedule"
      />
    </div>
  </div>
</template