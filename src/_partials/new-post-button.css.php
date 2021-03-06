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
	border-radius: 2rem;
	font-size: 2rem;
	font-weight: bold;
	line-height: 1em;
	text-decoration: none !important;
	color: var(--accent1b);
	background-color: var(--accent2a);
	box-shadow: var(--material-shadow1);
	transform: none;
	opacity: 1;
	transition: box-shadow .3s, transform .3s, opacity .3s;
}

html.is-animating .new-post-button {
	transform: translateY(5rem);
	opacity: 0;
	pointer-events: none;
}


@media (min-width: 720px) {

	.new-post-button {
		width: auto;
		padding: 0 1rem;
	}
	.new-post-button::after {
		content: "Post";
		margin-left: .5rem;
    }

}


@media (hover: hover) {

	.new-post-button:hover {
		color: var(--accent1c);
		background-color: var(--accent2b);
		box-shadow: var(--material-shadow2);
	}

}
</style>