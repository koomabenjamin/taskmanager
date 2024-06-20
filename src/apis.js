const BASE_URL = import.meta.env.VITE_API_URL;
console.log("BASE URL: ", BASE_URL);

export const API_URLS = {
  REGISTER: `${BASE_URL}/api/auth/register`,
  LOGIN: `${BASE_URL}/api/auth/login`,
};