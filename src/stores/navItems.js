import { defineStore } from 'pinia';
import { ref } from 'vue';

export const useNavItemsStore = defineStore('navItems', () => {
  const navItems = ref([
    { label: 'Plan', icon: 'CalendarIcon', subList: [] },
    {
      label: 'Task List', name: 'task', icon: 'ClipboardDocumentListIcon', subList: [
        { name: 'Meridian', color: '#f9a8d4' },
        { name: 'Risen', color: '#60FB24' },
        { name: 'SkillBox', color: '#d1d5db' },
        { name: 'Statra Insurance', color: '#f5f3ff' },
      ]
    },
    {
      label: 'Projects', name: 'project', icon: 'FolderIcon', subList: [
        { name: 'Meridian', color: 'bg-rose-600' },
        { name: 'Risen', color: 'bg-blue-600' },
        { name: 'SkillBox', color: 'bg-yellow-400' },
        { name: 'Statra Insurance', color: '#f9a8d4' },
      ]
    },
    {
      label: 'Tags', name: 'tag', icon: 'TagIcon', subList: [
        { name: 'Prototype', color: '#86198f' },
        { name: 'Research', color: '#5b21b6' },
        { name: 'Testing', color: '#e9d5ff' },
      ]
    },
    {
      label: 'Members', name: 'member', icon: 'UserGroupIcon', subList: [
        { name: 'Prototype', color: '#e9d5ff' },
        { name: 'Research', color: '#86198f' },
        { name: 'Testing', color: '#5b21b6' },
      ]
    },
  ]);

  const updateProjectsInNavItems = (projects) => {
    const projectsNavItem = navItems.value.find(item => item.label === 'Projects');
    if (projectsNavItem) {
      projectsNavItem.subList = projects.map(project => ({
        name: project.project_name,
        color: project.project_color
      }));
    }
  };

  const updateTagsInNavItems = (tags) => {
    const tagsNavItem = navItems.value.find(item => item.label === 'Tags');
    if (tagsNavItem) {
      tagsNavItem.subList = tags.map(tag => ({
        name: tag.tag_name,
        color: tag.tag_color
      }));
    }
  };


  const updateMembersInNavItems = (members) => {
    const membersNavItem = navItems.value.find(item => item.label === 'Members');
    if (membersNavItem) {
      membersNavItem.subList = members.map(member => ({
        name: member.name,
        color: '#5b21b6'
      }));
    }
  };

  return { navItems, updateProjectsInNavItems, updateTagsInNavItems, updateMembersInNavItems };
});
