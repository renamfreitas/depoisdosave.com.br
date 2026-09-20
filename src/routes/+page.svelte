<svelte:head>
	<title>Depois do Save</title>
</svelte:head>

<main class="stage">
	<div class="aurora" aria-hidden="true"></div>
	<div class="grain" aria-hidden="true"></div>

	<h1 class="title">
		<span class="lead">Acessar o canal</span>
		<a
			class="brand"
			href="https://www.youtube.com/@canaldepoisdosave"
			target="_blank"
			rel="noopener noreferrer"
		>
			depois do save
		</a>
	</h1>
</main>

<style>
	.stage {
		position: relative;
		isolation: isolate;
		display: grid;
		place-items: center;
		min-height: 100svh;
		padding: 1.5rem;
		overflow: hidden;
		background:
			radial-gradient(ellipse 80% 55% at 50% 115%, rgba(34, 92, 62, 0.45), transparent 60%),
			linear-gradient(165deg, #07110d 0%, #0c1210 42%, #121a16 100%);
	}

	.aurora {
		position: absolute;
		inset: -20% -10% auto;
		height: 70%;
		background:
			radial-gradient(ellipse at 30% 40%, var(--glow-dim), transparent 55%),
			radial-gradient(ellipse at 70% 30%, rgba(90, 160, 140, 0.22), transparent 50%);
		filter: blur(28px);
		animation: drift 14s ease-in-out infinite alternate;
		pointer-events: none;
		z-index: -2;
	}

	.grain {
		position: absolute;
		inset: 0;
		opacity: 0.07;
		background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
		pointer-events: none;
		z-index: -1;
		animation: flicker 5.5s steps(2, end) infinite;
	}

	.title {
		margin: 0;
		max-width: 18ch;
		text-align: center;
		font-size: clamp(1.85rem, 5.5vw, 3.25rem);
		font-weight: 700;
		line-height: 1.2;
		letter-spacing: -0.03em;
		animation: rise 0.9s cubic-bezier(0.22, 1, 0.36, 1) both;
	}

	.lead {
		display: block;
		font-weight: 500;
		opacity: 0.72;
	}

	.brand {
		display: inline-block;
		margin-top: 0.35em;
		color: var(--glow);
		text-decoration: none;
		background-image: linear-gradient(currentColor, currentColor);
		background-position: 0 100%;
		background-repeat: no-repeat;
		background-size: 0% 2px;
		transition:
			background-size 0.35s ease,
			text-shadow 0.35s ease,
			transform 0.35s ease;
	}

	.brand:hover,
	.brand:focus-visible {
		background-size: 100% 2px;
		text-shadow: 0 0 24px rgba(125, 255, 179, 0.35);
		transform: translateY(-1px);
		outline: none;
	}

	@keyframes rise {
		from {
			opacity: 0;
			transform: translateY(18px);
			filter: blur(4px);
		}
		to {
			opacity: 1;
			transform: translateY(0);
			filter: blur(0);
		}
	}

	@keyframes drift {
		from {
			transform: translate3d(-3%, 0, 0) scale(1);
		}
		to {
			transform: translate3d(4%, 4%, 0) scale(1.05);
		}
	}

	@keyframes flicker {
		0%,
		100% {
			opacity: 0.06;
		}
		50% {
			opacity: 0.09;
		}
	}

	@media (prefers-reduced-motion: reduce) {
		.aurora,
		.grain,
		.title,
		.brand {
			animation: none;
			transition: none;
		}
	}
</style>
