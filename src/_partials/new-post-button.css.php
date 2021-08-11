<style>
.new-post-button {
	z-index: 2000;
	display: flex;
	align-items: center;
	justify-content: center;
	position: fixed;
	bottom: calc(1.5rem + var(--navbar-height));
	right: 1.5rem;
	right: calc(1.5rem + env(safe-area-inset-right));
	width: 4rem;
	height: 4rem;
	font-size: 2.5rem;
	line-height: 1em;
	color: var(--accent1b);
	background-color: var(--accent2a);
	border-radius: 50%;
	box-shadow: var(--material-shadow1);
	transition: box-shadow .3s;
}
.new-post-button:hover {
	color: var(--accent1c);
	background-color: var(--accent2b);
	box-shadow: var(--material-shadow2);
}
</style>