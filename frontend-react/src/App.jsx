import { useState, useEffect } from "react";
import axios from "axios";
import "./App.css";

function App() {
  const [page, setPage] = useState("login");
  const [token, setToken] = useState(localStorage.getItem("token") || "");
  const [posts, setPosts] = useState([]);
  const [showModal, setShowModal] = useState(false);
  const [editMode, setEditMode] = useState(false);
  const [currentPost, setCurrentPost] = useState({ id: "", title: "", content: "" });

  useEffect(() => {
    if (token) {
      setPage("posts");
      fetchPosts();
    }
  }, [token]);

  const fetchPosts = async () => {
    try {
      const res = await axios.get("http://localhost:8000/api/posts", {
        headers: { Authorization: `Bearer ${token}` },
      });
      setPosts(res.data.data);
    } catch (err) {
      console.log(err);
    }
  };

  const handleLogin = async (e) => {
    e.preventDefault();
    try {
      const res = await axios.post("http://localhost:8000/api/login", {
        email: e.target.email.value,
        password: e.target.password.value,
      });

      localStorage.setItem("token", res.data.token);
      setToken(res.data.token);
    } catch {
      alert("Login gagal");
    }
  };

  const handleLogout = () => {
    localStorage.removeItem("token");
    setToken("");
    setPage("login");
  };

  // CREATE POST
  const handleCreate = () => {
    setEditMode(false);
    setCurrentPost({ id: "", title: "", content: "" });
    setShowModal(true);
  };

  // EDIT POST
  const handleEdit = (post) => {
    setEditMode(true);
    setCurrentPost({ id: post.id, title: post.title, content: post.content });
    setShowModal(true);
  };

  // SAVE POST (Create or Update)
  const handleSave = async (e) => {
    e.preventDefault();
    try {
      if (editMode) {
        // UPDATE
        await axios.put(
          `http://localhost:8000/api/posts/${currentPost.id}`,
          { title: currentPost.title, content: currentPost.content },
          { headers: { Authorization: `Bearer ${token}` } }
        );
        alert("Post berhasil diupdate!");
      } else {
        // CREATE
        await axios.post(
          "http://localhost:8000/api/posts",
          { title: currentPost.title, content: currentPost.content },
          { headers: { Authorization: `Bearer ${token}` } }
        );
        alert("Post berhasil dibuat!");
      }
      setShowModal(false);
      fetchPosts();
    } catch (err) {
      alert("Gagal menyimpan post");
      console.log(err);
    }
  };

  // DELETE POST
  const handleDelete = async (id) => {
    if (!confirm("Yakin ingin menghapus post ini?")) return;
    
    try {
      await axios.delete(`http://localhost:8000/api/posts/${id}`, {
        headers: { Authorization: `Bearer ${token}` },
      });
      alert("Post berhasil dihapus!");
      fetchPosts();
    } catch (err) {
      alert("Gagal menghapus post");
      console.log(err);
    }
  };

  return (
    <div className="app-container">
      
      {/* LOGIN PAGE */}
      {page === "login" && (
        <div className="login-page">
          <div className="login-card">
            <div className="login-header">
              <div className="emoji">👋</div>
              <h2>Selamat Datang</h2>
              <p>Silakan login untuk melanjutkan</p>
            </div>

            <form onSubmit={handleLogin}>
              <input
                name="email"
                type="email"
                placeholder="Email"
                required
              />
              
              <input
                name="password"
                type="password"
                placeholder="Password"
                required
              />

              <button type="submit" className="btn-login">
                Login
              </button>
            </form>
          </div>
        </div>
      )}

      {/* POSTS PAGE */}
      {page === "posts" && (
        <div className="posts-page">
          <div className="posts-container">
            
            <div className="navbar">
              <div>
                <h2>📌 Daftar Posts</h2>
                <p>Temukan cerita menarik dari komunitas</p>
              </div>
              
              <div className="navbar-actions">
                <button onClick={handleCreate} className="btn-create">
                  ➕ Buat Post
                </button>
                <button onClick={handleLogout} className="btn-logout">
                  Logout
                </button>
              </div>
            </div>

            {posts.length === 0 && (
              <div className="empty-state">
                <div className="emoji-large">📭</div>
                <p>Belum ada post tersedia</p>
                <button onClick={handleCreate} className="btn-create-empty">
                  Buat Post Pertama
                </button>
              </div>
            )}

            <div className="posts-list">
              {posts.map((post, index) => (
                <div key={post.id} className="post-card" style={{animationDelay: `${index * 0.1}s`}}>
                  <div className="accent-bar"></div>
                  
                  <div className="post-content">
                    <h3>{post.title}</h3>
                    <p>{post.content}</p>

                    <div className="post-footer">
                      <div className="author-info">
                        <div className="avatar">
                          {post.user?.name?.charAt(0).toUpperCase() || "?"}
                        </div>
                        <div>
                          <p className="author-name">{post.user?.name}</p>
                          <p className="author-label">Penulis</p>
                        </div>
                      </div>
                      
                      <div className="post-actions">
                        <button 
                          onClick={() => handleEdit(post)} 
                          className="btn-edit"
                          title="Edit"
                        >
                          ✏️
                        </button>
                        <button 
                          onClick={() => handleDelete(post.id)} 
                          className="btn-delete"
                          title="Hapus"
                        >
                          🗑️
                        </button>
                      </div>
                    </div>

                    <div className="date-info-bottom">
                      <p className="date">
                        {new Date(post.created_at).toLocaleDateString('id-ID', {
                          day: 'numeric',
                          month: 'long',
                          year: 'numeric'
                        })}
                      </p>
                      <p className="time">
                        {new Date(post.created_at).toLocaleTimeString('id-ID', {
                          hour: '2-digit',
                          minute: '2-digit'
                        })}
                      </p>
                    </div>
                  </div>
                </div>
              ))}
            </div>
          </div>
        </div>
      )}

      {/* MODAL CREATE/EDIT */}
      {showModal && (
        <div className="modal-overlay" onClick={() => setShowModal(false)}>
          <div className="modal-content" onClick={(e) => e.stopPropagation()}>
            <div className="modal-header">
              <h3>{editMode ? "✏️ Edit Post" : "➕ Buat Post Baru"}</h3>
              <button className="btn-close" onClick={() => setShowModal(false)}>
                ✕
              </button>
            </div>

            <form onSubmit={handleSave}>
              <div className="form-group">
                <label>Judul</label>
                <input
                  type="text"
                  placeholder="Masukkan judul post"
                  value={currentPost.title}
                  onChange={(e) => setCurrentPost({...currentPost, title: e.target.value})}
                  required
                />
              </div>

              <div className="form-group">
                <label>Konten</label>
                <textarea
                  placeholder="Masukkan konten post"
                  rows="6"
                  value={currentPost.content}
                  onChange={(e) => setCurrentPost({...currentPost, content: e.target.value})}
                  required
                ></textarea>
              </div>

              <div className="modal-actions">
                <button type="button" onClick={() => setShowModal(false)} className="btn-cancel">
                  Batal
                </button>
                <button type="submit" className="btn-save">
                  {editMode ? "💾 Update" : "✅ Simpan"}
                </button>
              </div>
            </form>
          </div>
        </div>
      )}
    </div>
  );
}

export default App;