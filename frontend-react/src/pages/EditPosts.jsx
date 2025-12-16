import { useEffect, useState } from "react";
import axios from "axios";
import { useNavigate, useParams } from "react-router-dom";

function EditPost() {
  const { id } = useParams();
  const navigate = useNavigate();

  const [title, setTitle] = useState("");
  const [content, setContent] = useState("");

  const token = localStorage.getItem("token");

  useEffect(() => {
    loadPost();
  }, []);

  const loadPost = async () => {
    try {
      const res = await axios.get(`http://localhost:8000/api/posts/${id}`);
      setTitle(res.data.data.title);
      setContent(res.data.data.content);
    } catch (err) {
      alert("Gagal memuat data!");
    }
  };

  const handleUpdate = async (e) => {
    e.preventDefault();

    try {
      await axios.put(
        `http://localhost:8000/api/posts/${id}`,
        { title, content },
        { headers: { Authorization: `Bearer ${token}` } }
      );

      navigate("/posts");
    } catch (err) {
      alert("Gagal mengupdate post!");
    }
  };

  return (
    <div className="form-container">
      <h2>Edit Post</h2>

      <form onSubmit={handleUpdate}>
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

        <button type="submit" className="btn-primary">Update</button>
      </form>
    </div>
  );
}

export default EditPost;
