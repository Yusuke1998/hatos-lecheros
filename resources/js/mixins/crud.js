const crudMixin = {
	created() {
		this.$bus.$on("register", idTarget => {
			if (this.id == idTarget) {
				this.register(this.createUrl, idTarget);
			}
		});

		this.$bus.$on("edit", () => {
			this.edit(this.updateUrl);
		});

		this.$bus.$on("clear", () => {
			this.resetForm();
		});

		this.$bus.$on("data", ({ data, event }) => {
			for (let property in this.form) {
				this.form[property] = data[property];
			}

			if (event) {
				//Si se manda event como true, se ejecuta automatico el evento de eliminar
				this.delete(this.deleteUrl);
			}
		});
	},

	methods: {
		register(url, id) {
			this.axios
				.post(url, this.form)
				.then(response => {
					swal(
						"Exelente",
						"Se realizo registro correctamente",
						"success"
					).then(value => {
						utils.reload();
					});
				})
				.catch(error => {
					swal("Error", "Error al crear", "error");
				});
		},

		edit(url) {
			let id = this.form.id;
			let endpoint = `${url}/${id}`;

			this.axios
				.put(endpoint, this.form)
				.then(response => {
					swal(
						"Exelente",
						"registro modificado correctamente",
						"success"
					).then(value => {
						utils.reload();
					});
				})
				.catch(error => {
					swal("Error", "Error al editar", "error");
				});
		},

		delete(url) {
			let id = this.form.id;
			let endpoint = `${url}/${id}`;

			swal({
				title: "Seguro quieres eliminar este item?",
				text: "una vez borrado, no podras recuperar el registro!",
				icon: "warning",
				buttons: true,
				dangerMode: true
			}).then(willDelete => {
				if (willDelete) {
					axios
						.delete(endpoint)
						.then(() => {
							swal("Tu registro ha sido borrado!", {
								icon: "success"
							}).then(value => {
								utils.reload();
							});
						})
						.catch(error => {
							swal("Tu registro no pudo ser borrado!", {
								icon: "error"
							});
						});
				} else {
					return;
				}
			});
		},

		resetForm() {
			for(let property in this.form){
				this.form[property] = ''
			}

			this.form.id = null;
		},
	}
};

export default crudMixin;
