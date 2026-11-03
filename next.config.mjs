/** The website's pages are plain HTML in public/; the closet designer is the Next.js app at /designer. */
const nextConfig = {
  async rewrites() {
    return { beforeFiles: [{ source: "/", destination: "/index.html" }] };
  },
  // Old page addresses (and the current site's /gallery/ and /getting-started/) go to home page sections.
  async redirects() {
    const to = { work: ["/gallery.html", "/gallery", "/our-work"], process: ["/getting-started.html", "/getting-started"], services: ["/what-we-build.html", "/what-we-build"] };
    return Object.entries(to).flatMap(([id, paths]) => paths.map((source) => ({ source, destination: `/#${id}`, permanent: false })));
  },
};
export default nextConfig;
