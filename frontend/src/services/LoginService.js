
import http from "../plugins/axios";

class LoginService {
    login(data) {
        return http.post('/login', data);
    }
}

export default new LoginService();
