var projectApp = new Vue({
    el: '#project-app',
    data: {
        projects: [],
        activeButton: ''
    },
    created: function() {
        this.loadProjects();
        this.activeButton = localStorage.getItem('projectActiveButton') || 'all';
    },
    methods: {
        loadProjects: function() {
            this.$http.get("/api/project").then(function(res) {
                this.projects = res.data;
            });
        },
        labelClass: function(project) {
            return project.is_public ? 'label-info' : 'label-danger';
        },
        labelText: function(project) {
            return project.is_public ? 'public' : 'private';
        },
        getActiveButton: function(btn) {
            return btn == this.activeButton ? 'active' : '';
        },
        setActiveButton: function(btn) {
            localStorage.setItem('projectActiveButton', btn);
            this.activeButton = btn;
        }
    },
    computed: {
        filteredProjects: function() {
            var button = this.activeButton;
            if (button == 'all') {
                return this.projects;
            } else {
                return this.projects.filter(function(project) {
                    return button == 'public' ? project.is_public == 1 : project.is_public == 0;
                });
            }
        },
    }
});
