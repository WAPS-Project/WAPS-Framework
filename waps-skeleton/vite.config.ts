import { defineConfig } from "vite";
import path from "path";

export default defineConfig({
	build: {
		outDir: path.resolve(__dirname, "./src/content/js"),
		rollupOptions: {
			input: "./src/src/ts/index.ts",
			output: {
				entryFileNames: "main.js",
				format: "es",
				dir: path.resolve(__dirname, "./src/content/js"),
			},
		},
		sourcemap: "inline",
	},
	resolve: {
		alias: {
			"@": path.resolve(__dirname, "src"),
		},
		extensions: [".ts", ".js"],
	},
	esbuild: {
		loader: "tsx",
		include: /\.tsx?$/,
		exclude: /node_modules/,
	},
});
