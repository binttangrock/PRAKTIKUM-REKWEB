import { createContext, useContext, useState, useEffect } from "react";
import API from "../api";

const AuthContext = createContext(null);

export function AuthProvider({ children }) {
    const [user, setUser] = useState(null);
    const [isAuthenticated, setIsAuthenticated] = useState(false);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        const token = localStorage.getItem("token");

        if (!token) {
            setLoading(false);
            return;
        }

        // ✅ VALIDASI TOKEN KE BACKEND
        API.get("/user")
            .then((res) => {
                setUser(res.data);
                setIsAuthenticated(true);
            })
            .catch(() => {
                localStorage.removeItem("token");
                localStorage.removeItem("user");
            })
            .finally(() => {
                setLoading(false);
            });
    }, []);

    const login = (userData, token) => {
        localStorage.setItem("token", token);
        localStorage.setItem("user", JSON.stringify(userData));
        setUser(userData);
        setIsAuthenticated(true);
    };

    const logout = () => {
        localStorage.removeItem("token");
        localStorage.removeItem("user");
        setUser(null);
        setIsAuthenticated(false);
    };

    // ✅ JANGAN return null
    if (loading) {
        return <div className="text-center mt-20">Loading...</div>;
    }

    return (
        <AuthContext.Provider
            value={{ user, isAuthenticated, login, logout }}
        >
            {children}
        </AuthContext.Provider>
    );
}

export function useAuth() {
    const context = useContext(AuthContext);
    if (!context) {
        throw new Error("useAuth harus di dalam AuthProvider");
    }
    return context;
}
