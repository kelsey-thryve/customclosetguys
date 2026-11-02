/** The website's pages are plain HTML in public/; the closet designer is the Next.js app at /designer. */
const nextConfig = {
  async rewrites() {
    return { beforeFiles: [{ source: "/", destination: "/index.html" }] };
  },
};
export default nextConfig;
