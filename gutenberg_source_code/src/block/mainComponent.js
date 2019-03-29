import './style.scss';
import './editor.scss';
import React, {Component} from 'react';
import DropdownComponent from './dropdownComponent';

const {registerBlockType} = wp.blocks;
const blockName = 'cgb/block-mightyforms';

registerBlockType(blockName, {

	title: 'MightyForms',
	icon: <img src={backendData.gutenbergPluginRootFolder} width="20" height="20" alt=""/>,
	category: 'common',
	attributes: {},
	edit: class extends Component {

		constructor() {
			super();
			this.state = {
				userFormsData: [],
				isBlockAddedFlag: false,
				selectedFormId: null,
				test: null
			}
		}

		setFormSelection = (formId) => {
			formId ? this.props.attributes.selectedFormId = formId : null;
		};

		/**
		 * This function used for deferred execution of render();
		 * So, first of all we get data from API, and then - render result.
		 */

		render() {

			fetch(`http://localhost:3000/api/v1/${backendData.mightyformsApiKey}/forms`)
				.then(response => response.json())
				.then(response => {

					let responseData = response['data'];
					window.userFormsData = responseData;
					this.setState({
						userFormsData: responseData
					})
				});

			return (

				<DropdownComponent
					userForms={this.state.userFormsData}
					selectedFormId={this.state.selectedFormId}
					setFormSelection={this.setFormSelection}/>
			);
		}
	},

	save: class extends Component {

		render() {
			return (
				<iframe
					src={`https://app.mightyforms.com/form/${this.props.attributes.selectedFormId}/design`}
					width="100%"
					height="400px"
					frameBorder="0">
				</iframe>
			);
		}
	},
});
