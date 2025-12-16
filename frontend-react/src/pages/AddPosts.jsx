import { useState } from "react";
import axios from "axios";
import { useNavigate } from "react-router-dom";

function AddPost() {
  const [title, setTitle] = useState("");
  const [content, setContent] = useState("");

  const navigate = useNavigate();
  const token = localStorage.getItem("token");

  const handleSubmit = async (e) => {
    e.preventDefault();

    try {
      await axios.post(
        "http://localhost:8000/api/posts",
        { title, content },
        { headers: { Authorization: `Bearer ${token}` } }
      );

      navigate("/posts");
    } catch (err) {
      alert("Gagal menambah post!");
    }
  };

  return (
    <div className="form-container">
      <h2>Tambah Post</h2>

      <form onSubmit={handleSubmit}>
        <input
          type="text"
          placeholder="Judul"
          value={title}
          onChange={(e) => setTitle(e.target.value)}
        />

        <textarea
          placeholder="Isi konten"
          value={content}
          onChange={(e) => setContent(e.target.value)}
        />

        <button type="submit" className="btn-primary">Simpan</button>
      </form>
    </div>
  );
}

export default AddPost;
