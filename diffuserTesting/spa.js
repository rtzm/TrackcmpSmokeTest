function transition(route) {
  history.pushState({ route: route }, '', route);
  renderRoute(route);

  if (shouldUpdate()) {
    window.vgo('update');
  }
}

window.onpopstate = function(event) {
  renderRoute(event.state.route);
};

var route = window.location.href.split('/').pop();

window.pages = {
  'login.html': {
    title: 'Login',
    render: function(page) {
      var loginButton = document.createElement('button');
      loginButton.innerHTML = 'Log in';
      loginButton.onclick = function() {
        transition('spa.html');
      };
      page.appendChild(loginButton);
    }
  },
  'spa.html': {
    title: 'App',
    render: function(page) {
      var logoutButton = document.createElement('button');
      logoutButton.innerHTML = 'Log out';
      logoutButton.onclick = function() {
        transition('logout.html');
      };
      page.appendChild(logoutButton);
    }
  },
  'logout.html': {
    title: 'Logged out',
    render: function(page) {
      var loginButton = document.createElement('button');
      loginButton.innerHTML = 'Log in';
      loginButton.onclick = function() {
        transition('spa.html');
      };
      page.appendChild(loginButton);
    }
  }
};

function renderRoute(route) {
  var page = document.body.querySelector('#page');

  if (!page) {
    page = document.createElement('div');
    page.id = 'page';
    document.body.appendChild(page);
  }

  page.innerHTML = '';

  var title = document.createElement('h1');
  title.innerHTML = pages[route].title;

  page.appendChild(title);

  pages[route].render(page);

  var updateToggle = document.createElement('button');
  updateToggle.innerHTML = shouldUpdate() ? 'Disable update' : 'Enable update';
  updateToggle.onclick = function() {
    if (shouldUpdate()) {
      disableUpdate();
      updateToggle.innerHTML = 'Enable update';
    } else {
      enableUpdate();
      updateToggle.innerHTML = 'Disable update';
    }
  };
  page.appendChild(updateToggle);
}

function enableUpdate() {
  localStorage.setItem('update', 1);
}

function disableUpdate() {
  localStorage.removeItem('update');
}

function shouldUpdate() {
  return localStorage.getItem('update') === '1';
}

renderRoute(route);
