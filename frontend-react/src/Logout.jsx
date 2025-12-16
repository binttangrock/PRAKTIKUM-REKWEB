import { useEffect } from "react";
import { useNavigate } from "react-router-dom";
import API from "./api";

export default function Logout() {
    const navigate = useNavigate();

    useEffect(() => {
        handleLogout();
    }, []); // Hanya dijalankan sekali saat komponen dimuat

    const handleLogout = async () => {
        try {
            // Panggil API Logout (meskipun token sudah terhapus, ini untuk membersihkan server side)
            // Interceptor di api.js akan tetap mengirim token sebelum dihapus
            await API.post("/logout"); 
        } catch (error) {
            // Error 401 (Unauthorized) mungkin terjadi jika token sudah kadaluarsa,
            // tapi kita tetap proses logout di sisi klien.
            console.warn("Gagal menghubungi endpoint logout server, tapi token klien akan dihapus.");
        }
        
        // Hapus token dari browser
        localStorage.removeItem("api_token");
        alert("Anda telah logout.");
        
        // Arahkan ke halaman utama
        navigate("/");
        // Refresh halaman untuk memuat ulang Auth Context (jika sudah ada)
        window.location.reload(); 
    };

    return (
        <div className="text-center p-8">
            <h2 className="text-xl">Memproses Logout...</h2>
        </div>
    );
}