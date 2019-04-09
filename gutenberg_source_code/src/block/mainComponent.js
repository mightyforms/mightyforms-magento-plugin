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
				waitForContent: true
			}
		}

		setFormSelection = (formId) => {
			formId ? this.props.attributes.selectedFormId = formId : null;
		};

		/**
		 * This function used for deferred execution of render();
		 * So, first of all we get data from API, and then - render result.
		 */

		componentDidMount() {

			if (backendData.mightyformsApiKey !== null) {

				fetch(`http://localhost:3000/api/v1/${backendData.mightyformsApiKey}/forms`)
					.then(response => response.json())
					.then(response => {

						console.log('response', response);
						if (response['success'] === true) {
							let responseData = response['data'];
							window.userFormsData = responseData;
							this.setState({
								userFormsData: responseData,
								waitForContent: false
							});
						} else {
							//If API key is wrong, we should resume execution.
							//So, let's set waitForContent: false, and user will see message about wrong key;
							this.setState({waitForContent: false});
						}
					});
			} else {
				this.setState({
					waitForContent: false
				})
			}
		}

		render() {

			if (this.state.waitForContent === true) {
				return (<div className="mightyforms-container">
					<h5 className="loading">Loading...</h5>
				</div>);
			} else {

				if (this.state.userFormsData.length > 0) {

					return (

						<DropdownComponent
							userForms={this.state.userFormsData}
							selectedFormId={this.state.selectedFormId}
							setFormSelection={this.setFormSelection}/>
					);

				} else {

					return (
						<div className="mightyforms-container">
							<div className="mf-title"><img src={backendData.gutenbergPluginRootFolder}/> MightyForms
							</div>

							<div>API key is wrong, or it's not set up. Please, check your API key on plugin&nbsp;
								<a href={backendData.settingPageUrl}>settings page</a>
							</div>
						</div>
					);
				}
			}
		}
	},

	save: function () {
		return null
	}

	// save: class extends Component {
	//
	// 	render() {
	// 		// console.log()
	// 		return (
	// 			<iframe
	// 				src={`https://dev.mightyforms.com/form/${this.props.attributes.selectedFormId}/design`}
	// 				width="100%"
	// 				height="400px"
	// 				frameBorder="0">
	// 			</iframe>
	// 		);
	// 	}
	// },
});
