function createHeaderAndFooter() {
	var header = `
	`;

	var footer = `
	`;

  var modals =`

	`;
	document.body.innerHTML = modals + document.body.innerHTML + footer;
}
window.addEventListener("load", createHeaderAndFooter);
