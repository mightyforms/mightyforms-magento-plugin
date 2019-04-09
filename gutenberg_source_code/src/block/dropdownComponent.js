import React from 'react'

class DropdownComponent extends React.Component {

	render() {

		let userForms = this.props.userForms;


		let options = userForms.map((post, index) => {

			if (index === 0) {
				return (<option key={index} selected="true" value={post.project_id}>{post.project_name}</option>);
			}

			return (<option key={index} value={post.project_id}>{post.project_name}</option>);

		});

		return (
			<div className="mightyforms-container">
				<div className="mf-title"><img src={backendData.gutenbergPluginRootFolder} /> MightyForms</div>
				<div>Select needed form from dropdown, and it will be shown on this page</div>

				<select value={this.props.selectedFormId}
						onChange={(event) => {
							this.props.setFormSelection(event.target.querySelector('option:checked').value)
						}}
				>
					{options}
				</select>
			</div>
		)
	}
}

export default DropdownComponent;
