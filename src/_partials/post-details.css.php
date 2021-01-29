<style>
.post-details {
	display: grid;
	grid-template-rows: auto auto;
	grid-gap: 2rem;
	align-items: start;
}
.post-details__figure {
	background-color: var(--background2);
	border: 1px solid var(--text4);
	border-radius: var(--border-radius1);
	overflow: hidden;
}
.post-details__image {
	width: 100%;
	height: auto;
	margin: auto;
}
.post-details__description {
    font-size: 1.2em;
}
.post-details__author,
.post-details__date-posted {
    font-size: .9em;
    color: var(--text3);
}


@media (min-width: 720px) {

	.post-details {
		grid-template-columns: auto minmax(240px, 1fr);
		grid-template-rows: none;
    }
    
}
</style>