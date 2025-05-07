import { defineStore } from 'pinia';

export const useMemberStore = defineStore('memberStore', {
  state: () => ({
    members: []
  }),
  actions: {
    addMember(member) {
      this.members.push(member);
    },
    removeMember(memberId) {
      this.members = this.members.filter(member => member.id !== memberId);
    }
  },
  getters: {
    getMembers: (state) => state.members
  }
});
