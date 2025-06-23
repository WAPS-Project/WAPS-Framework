// index.ts
console.log("WAPS Skeleton TypeScript läuft!");

document.addEventListener("DOMContentLoaded", () => {
	const status = document.querySelector(".status");
	if (status) {
		status.textContent = "Frontend (TypeScript) ist bereit!";
	}

	// Bootstrap Tooltip initialisieren
	const tooltipTriggerList = document.querySelectorAll(
		'[data-bs-toggle="tooltip"]'
	);
	const tooltipList = [...tooltipTriggerList].map(
		(tooltipTriggerEl) =>
			new (window as any).bootstrap.Tooltip(tooltipTriggerEl)
	);

	// Beispiel für SweetAlert2 Integration
	const showWelcomeMessage = () => {
		if ((window as any).Swal) {
			(window as any).Swal.fire({
				title: "Willkommen!",
				text: "WAPS Framework ist bereit.",
				icon: "success",
				confirmButtonText: "OK",
			});
		}
	};

	// Optional: Willkommensnachricht beim ersten Besuch
	if (!localStorage.getItem("waps-welcome-shown")) {
		showWelcomeMessage();
		localStorage.setItem("waps-welcome-shown", "true");
	}
});
