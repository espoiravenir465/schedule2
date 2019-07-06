<template>
  <div class="schedule-list">
    <div class="grid">
      <Photo
        class="grid__item"
        v-for="schedule in scheules"
        :key="schedule.id"
        :item="schedule"
      />
    </div>
  </div>
</template