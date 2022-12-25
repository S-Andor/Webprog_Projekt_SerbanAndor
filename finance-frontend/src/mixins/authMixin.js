
import axios from "axios";

export default {
    created: function () {
        axios.get(`http://127.0.0.1:8000/api/check-token?id=${localStorage.user}&token=${localStorage.token}`).then((res) =>{
            if (res.data === false){
                this.$router.push('/login')
            }
            console.log(res)
        })
    },
}