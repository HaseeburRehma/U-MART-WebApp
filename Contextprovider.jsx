
import { createContext } from 'react';
const Statecontext = createContext({
    
    user: null,
    token: null,
    setuser: () => {},
    setToken: () => {}

})

export const ContextProvider = ({children}) => {

    const [user, setuser] = useState({
        name: 'Haseeb'
    });
    const [token, _setToken] = useState(123);

    const setToken = (token) => {
        _setToken(token)
        if(token){
            localStorage.setItem('Accesstoken', token);
        }
        else{
            localStorage.removeItem('Accesstoken');
        }

    }
    return (
        <Statecontext.Provider value={{
            user,
             token,
             setuser,
             setToken
             }}>
           {children}
        </Statecontext.Provider>
    )
}

export const useStateContext = () => useContext(Statecontext);
