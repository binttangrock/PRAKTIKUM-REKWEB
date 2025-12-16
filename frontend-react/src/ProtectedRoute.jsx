import { useAuth } from './context/AuthContext.jsx';
import { Navigate, Outlet } from 'react-router-dom';

const ProtectedRoute = () => {
    const { isAuthenticated, loading } = useAuth();
    
    // Tampilkan loading saat status auth belum diketahui
    if (loading) return <div className="p-8 text-center text-gray-600">Memuat...</div>; 
    
    // Jika authenticated, render kontennya (Outlet)
    // Jika tidak, redirect ke halaman login
    return isAuthenticated ? <Outlet /> : <Navigate to="/login" />;
};

export default ProtectedRoute;