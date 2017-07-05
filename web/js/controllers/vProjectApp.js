var projectApp = new Vue({
    el: '#project-app',
    data: {
        projects: [],
        activeButton: '',
        oldActiveButton: '',
        searchBy: '',
        oldSearchBy: '',
        pagination: {
            perPage: 7,
            page: 1,
            pageCount: 0
        },
        searchModel: 'ProjectSearch',
        urlPostfix: ''
    },
    created: function() {
        this.loadProjects(this.getUrl());
        this.activeButton = localStorage.getItem('projectActiveButton') || 'all';
    },
    methods: {
        getUrl: function() {
            return "/api/project?sort=-id&per-page="+this.pagination.perPage+"&page="+this.pagination.page+this.urlPostfix;
        },
        loadProjects: function(url) {
            this.$http.get(url).then(function(res) {
                this.projects = res.data;
                this.parsePagination(res.headers);
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
        },
        parsePagination: function(headers) {
            this.pagination['pageCount'] = parseInt(headers.map['X-Pagination-Page-Count']);
        },
        loadPage: function(event) {
            this.pagination.page = event.target.attributes[1].value;
            this.loadProjects(this.getUrl());
        }
    },
    computed: {
        filteredProjects: function() {
            // Делаем поиск по проектам
            if (this.searchBy != '' && this.oldSearchBy != this.searchBy) {
                this.oldSearchBy = this.searchBy;
                this.urlPostfix = '&ProjectSearch[title]='+this.searchBy;
                this.pagination.page = 1;
                this.loadProjects(this.getUrl());
            }

            // Если обнулили поиск - надо перезагрузить
            if (this.searchBy == '' && this.oldSearchBy != '') {
                this.oldSearchBy = '';
                this.urlPostfix = '';
                this.pagination.page = 1;
                this.loadProjects(this.getUrl());
            }

            if (this.activeButton != 'all' && this.activeButton != this.oldActiveButton) {
                var is_public = (this.activeButton == 'public' ? 1 : 0);
                this.oldActiveButton = this.activeButton;
                this.urlPostfix = '&ProjectSearch[is_public]='+is_public;
                this.pagination.page = 1;
                this.loadProjects(this.getUrl());
            }

            if (this.activeButton == 'all' && this.oldActiveButton != '') {
                this.oldActiveButton = '';
                this.urlPostfix = '';
                this.pagination.page = 1;
                this.loadProjects(this.getUrl());
            }

            return this.projects;
        },
    },
    filters: {
        formatDate: function (value) {
            if (value) {
                return moment(String(value)).format('L')
            }
        },
    }
});
