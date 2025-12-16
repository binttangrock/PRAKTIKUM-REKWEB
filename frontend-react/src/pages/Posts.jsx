import API from "../api";
import { useEffect, useState } from "react";
import { Link, useNavigate } from "react-router-dom";

export default function Posts() {
  const [posts, setPosts] = useState([]);
  const navigate = useNavigate();

  // Load posts
  const loadPosts = () => {
    API.get("/posts")
      .then(res => setPosts(res.data.data))
      .catch(err => console.error(err));
  };

  useEffect(() => {
    loadPosts();
  }, []);

  // Delete Post
  const handleDelete = async (id) => {
    if (!confirm("Yakin ingin menghapus post ini?")) return;

    try {
      await API.delete(`/posts/${id}`);
      loadPosts(); // refresh data
    } catch (err) {
      alert("Gagal menghapus post.");
      console.error(err);
    }
  };

  return (
    <div className="min-h-screen bg-gradient-to-br from-purple-50 via-blue-50 to-pink-50 py-12 px-4">
      <div className="max-w-4xl mx-auto">

        {/* Header */}
        <div className="text-center mb-12">
          <h1 className="text-5xl font-bold bg-gradient-to-r from-purple-600 to-blue-600 bg-clip-text text-transparent mb-3">
            📌 Daftar Posts
          </h1>
          <p className="text-gray-600 text-lg">
            Temukan cerita menarik dari komunitas
          </p>
        </div>

        {/* Add Post Button */}
        <div className="flex justify-end mb-6">
          <Link
            to="/add-post"
            className="px-5 py-3 rounded-xl bg-gradient-to-r from-purple-500 to-blue-500 text-white font-semibold shadow-md hover:shadow-lg hover:opacity-90 transition"
          >
            + Tambah Post
          </Link>
        </div>

        {/* Empty State */}
        {posts.length === 0 && (
          <div className="text-center py-20">
            <div className="text-6xl mb-4">📭</div>
            <p className="text-gray-500 text-lg">Belum ada post tersedia</p>
          </div>
        )}

        {/* Posts Grid */}
        <div className="space-y-6">
          {posts.map((post, index) => (
            <div
              key={post.id}
              className="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 hover:border-purple-200 transform hover:-translate-y-1"
              style={{
                animation: `fadeInUp 0.5s ease-out ${index * 0.1}s both`,
              }}
            >
              <div className="h-1.5 bg-gradient-to-r from-purple-500 via-blue-500 to-pink-500"></div>

              <div className="p-8">
                {/* Title */}
                <h3 className="text-2xl font-bold text-gray-800 mb-4 group-hover:text-purple-600 transition-colors duration-300">
                  {post.title}
                </h3>

                {/* Content */}
                <p className="text-gray-600 leading-relaxed mb-6 text-lg">
                  {post.content}
                </p>

                {/* Footer */}
                <div className="flex items-center justify-between pt-4 border-t border-gray-100">
                  <div className="flex items-center space-x-3">
                    <div className="w-10 h-10 rounded-full bg-gradient-to-br from-purple-400 to-blue-400 flex items-center justify-center text-white font-semibold shadow-md">
                      {post.user?.name?.charAt(0).toUpperCase() || "?"}
                    </div>
                    <div>
                      <p className="font-semibold text-gray-800">
                        {post.user?.name}
                      </p>
                      <p className="text-sm text-gray-500">Penulis</p>
                    </div>
                  </div>

                  {/* Edit & Delete Buttons */}
                  <div className="flex space-x-3">
                    <Link
                      to={`/edit-post/${post.id}`}
                      className="px-4 py-2 rounded-lg bg-blue-500 text-white hover:bg-blue-600 transition shadow"
                    >
                      Edit
                    </Link>
                    <button
                      onClick={() => handleDelete(post.id)}
                      className="px-4 py-2 rounded-lg bg-red-500 text-white hover:bg-red-600 transition shadow"
                    >
                      Hapus
                    </button>
                  </div>
                </div>
              </div>
            </div>
          ))}
        </div>
      </div>

      <style jsx>{`
        @keyframes fadeInUp {
          from {
            opacity: 0;
            transform: translateY(30px);
          }
          to {
            opacity: 1;
            transform: translateY(0);
          }
        }
      `}</style>
    </div>
  );
}
