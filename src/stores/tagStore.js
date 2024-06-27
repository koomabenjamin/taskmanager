import { defineStore } from 'pinia';

export const useTagStore = defineStore('tagStore', {
  state: () => ({
    tags: []
  }),
  actions: {
    addTag(tag) {
      this.tags.push(tag);
    },
    removeTag(tagId) {
      this.tags = this.tags.filter(tag => tag.id !== tagId);
    }
  },
  getters: {
    getTags: (state) => state.tags
  }
});
