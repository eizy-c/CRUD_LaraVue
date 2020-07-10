new Vue({
  	el: '#crud-task',
  	created: function() {
			this.getKeeps();
		},
  	data: {
  		keeps:[],
      pagination:{
        'total': 0,
        'current_page': 0,
        'per_page': 0,
        'last_page': 0,
        'from': 0,
        'to': 0
      },
      newKeep: '',
      fillKeep: {'id': '', 'keep': ''},
      errors: [],
      offset:3
  	},
    computed: {
      isActived: function() {
        return this.pagination.current_page;
      },
      pagesNumber: function() {
        if(!this.pagination.to){
          return [];
        }

        var from = this.pagination.current_page - this.offset; 
        if(from < 1){
          from = 1;
        }

        var to = from + (this.offset * 2); 
        if(to >= this.pagination.last_page){
          to = this.pagination.last_page;
        }

        var pagesArray = [];
        while(from <= to){
          pagesArray.push(from);
          from++;
        }
        return pagesArray;
      }
    },
  	methods: {
      changePage: function(page) {
        this.pagination.current_page = page;
        this.getKeeps(page);
      },
  		getKeeps: function(page) {
				var url = 'task?page='+page;
				axios.get(url).then(response => {
					this.keeps = response.data.tasks.data,
          this.pagination = response.data.pagination
  			});
  		},
      editKeep: function(keep) {
        this.fillKeep.id   = keep.id;
        this.fillKeep.keep = keep.keep;
        $('#editTask').modal('show');
      },

      updateKeep: function(id) {
        var url = 'task/' + id;
        axios.put(url, this.fillKeep).then(response => {
          this.getKeeps();
          this.fillKeep = {'id': '', 'keep': ''};
          this.errors   = [];
          $('#editTask').modal('hide');
          toastr.success('Tarea actualizada con éxito');
        }).catch(error => {
          this.errors = error.response.data;
        });
      },

  		deleteKeep: function(keep) {
				var url = 'task/'+keep.id;
				axios.delete(url).then(response => {
					this.getKeeps();
					toastr.success("Eliminado correctamente!");
  			});
			},

      createKeep: function() {
        var url = 'task';
        axios.post(url, {
          keep: this.newKeep
        }).then(response => {

          this.getKeeps();
          this.newKeep = '';
          this.errors = [];

          $('#addTask').modal('hide');
          toastr.success("Tarea registrada con éxito!");
        }).catch(error =>{
          this.errors = error.response.data;
        });
      }
  	}
});