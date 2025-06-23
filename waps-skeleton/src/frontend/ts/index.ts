// index.ts
console.log("WAPS Skeleton TypeScript läuft!");

document.addEventListener("DOMContentLoaded", () => {
	const status = document.querySelector(".status");
	if (status) {
		status.textContent = "Frontend (TypeScript) ist bereit!";
	}
});
