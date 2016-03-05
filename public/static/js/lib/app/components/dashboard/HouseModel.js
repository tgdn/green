//import Utils from '../../common/utils.js';

class UserModel {
    constructor(obj) {
        this.id = obj.id;
        this.full_name = obj.full_name;
        this.email = obj.email;
        this.created_at = obj.created_at;
        this.last_login = obj.last_login;
    }
}

class HouseModel {

    constructor(obj) {
        this.id = obj.id;
        this.name = obj.name;
        this.created_at = obj.created_at;
        this.modified_at = obj.modified_at;

        let _this = this;
        obj.members.forEach((user) => {
            _this.members.push(new UserModel(user));
        });

        // TODO same with bills

        this.onChanges = [];
    }

    /*subsribe(onChange) {
        this.onChanges.push(onChange);
    }

    inform() {
        Utils.store(this.key, this.users);
		this.onChanges.forEach(function (callback) { callback(); });
    }

    add() {
        this.users = this.users.concat({
			id: Utils.uuid(),
			name: title
		});

		this.inform();
    }*/
}

class House {
    constructor() {
        this.get_data();
    }

    get_data() {
        let _this = this;

        let url = document.location.pathname.concat(document.location.search ? document.location.search.concat('&json') : '?json');
        $.get(url, (json_r) => {
            let resp = JSON.parse(json_r);

            console.log(resp);
            //_this.house = new HouseModel(resp);
            _this.house = resp.house;
            _this.user = resp.you;
            //_this.user = new UserModel(resp.you);
        });
    }
}

export { UserModel, HouseModel, House }
